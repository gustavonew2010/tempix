<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class CloudflareMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ignorar a verificação para as rotas de verificação do Cloudflare e assets
        $excludedPaths = [
            'verify',
            'verify/*',
            'build/*',
            'assets/*',
            'storage/*',
            '_token',
            'sanctum/csrf-cookie'
        ];

        foreach ($excludedPaths as $path) {
            if ($request->is($path)) {
                return $next($request);
            }
        }

        // Verificar se a sessão existe e está verificada
        if (!$request->session()->has('turnstile_verified')) {
            // Salvar a URL pretendida na sessão
            $request->session()->put('url.intended', $request->fullUrl());
            $request->session()->save();
            
            return redirect()->route('cloudflare.verify');
        }

        // Pular verificação em ambiente local
        if (app()->environment('local')) {
            return $next($request);
        }

        // Acessar configurações do Cloudflare
        $config = config('cloudflare');
        
        if ($config['enabled']) {
            // Verifica se a requisição veio do Cloudflare
            if (!$request->header('CF-Ray')) {
                abort(403, 'Acesso direto não permitido');
            }

            // Verifica país usando a configuração
            $country = $request->header('CF-IPCountry');
            if ($country && !in_array($country, $config['allowed_countries'])) {
                abort(403, 'País não permitido');
            }

            // Verifica IPs bloqueados
            $clientIp = $request->ip();
            if (in_array($clientIp, $config['blocked_ips'])) {
                abort(403, 'IP bloqueado');
            }
        }

        return $next($request);
    }
} 