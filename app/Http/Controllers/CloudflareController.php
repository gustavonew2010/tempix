<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CloudflareController extends Controller
{
    public function show(Request $request)
    {
        // Se já estiver verificado, redireciona para home
        if ($request->session()->has('turnstile_verified')) {
            return redirect('/');
        }
        
        return view('cloudflare.verify');
    }

    public function verify(Request $request)
    {
        try {
            $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                'secret' => config('services.cloudflare.secret_key'),
                'response' => $request->input('cf-turnstile-response'),
                'remoteip' => $request->ip(),
            ]);

            if ($response->json('success')) {
                // Armazenar na sessão e garantir que seja salva
                $request->session()->put('turnstile_verified', true);
                $request->session()->save();
                
                // Pegar a URL pretendida ou usar a home como fallback
                $redirect = $request->session()->pull('url.intended', '/');
                
                // Garantir que a sessão seja salva antes do redirecionamento
                $request->session()->save();
                
                if ($request->expectsJson()) {
                    return response()->json(['redirect' => $redirect]);
                }
                
                return redirect($redirect)->with('turnstile_verified', true);
            }

            if ($request->expectsJson()) {
                return response()->json(['error' => 'Verificação falhou'], 422);
            }

            return back()->with('error', 'Verificação falhou. Por favor, tente novamente.');
        } catch (\Exception $e) {
            \Log::error('Erro na verificação Cloudflare: ' . $e->getMessage());
            
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Erro ao processar verificação'], 500);
            }

            return back()->with('error', 'Erro ao processar verificação. Por favor, tente novamente.');
        }
    }
} 