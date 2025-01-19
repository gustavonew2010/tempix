<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Log;

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
        $this->reportable(function (Throwable $e) {
            Log::error('Error: ' . $e->getMessage());
            Log::error('File: ' . $e->getFile());
            Log::error('Line: ' . $e->getLine());
            Log::error('Stack trace: ' . $e->getTraceAsString());
        });

        if (config('app.debug')) {
            $this->renderable(function (Throwable $e) {
                return response()->view('errors.500', ['exception' => $e], 500);
            });
        }
    }
}
