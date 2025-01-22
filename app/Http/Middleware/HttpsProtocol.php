<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Request;

class HttpsProtocol
{
    public function handle($request, Closure $next)
    {
        if (!$request->secure() && App::environment('production')) {
            // Força HTTPS em produção
            $request->setTrustedProxies([$request->getClientIp()], 
                Request::HEADER_X_FORWARDED_FOR | 
                Request::HEADER_X_FORWARDED_HOST | 
                Request::HEADER_X_FORWARDED_PORT | 
                Request::HEADER_X_FORWARDED_PROTO);

            if (!$request->isXmlHttpRequest()) {
                return redirect()->secure($request->getRequestUri());
            }
        }

        // Adiciona headers de segurança
        $response = $next($request);
        
        if (App::environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
            $response->headers->set('Content-Security-Policy', 'upgrade-insecure-requests');
        }

        return $response;
    }
} 