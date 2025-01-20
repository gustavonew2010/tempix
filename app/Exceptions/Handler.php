<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                // Desabilitar logging temporariamente
                $debug = [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ];

                // Se estiver em ambiente de desenvolvimento, incluir stack trace
                if (config('app.debug')) {
                    $debug['trace'] = collect($e->getTrace())
                        ->map(function ($trace) {
                            return \Illuminate\Support\Arr::except($trace, ['args']);
                        })
                        ->take(3) // Limitar a 3 níveis de stack trace
                        ->toArray();
                }

                return response()->json([
                    'error' => true,
                    'message' => $e->getMessage(),
                    'debug' => $debug
                ], 500);
            }
        });
    }
}
