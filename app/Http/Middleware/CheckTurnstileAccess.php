<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckTurnstileAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('turnstile_verified')) {
            return redirect()->route('turnstile.verify');
        }

        return $next($request);
    }
} 