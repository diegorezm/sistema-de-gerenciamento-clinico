<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function (DomainException $e, Request $request) {
            // log with context
            Log::warning($e->getMessage(), [
                'user_id' => Auth::id(),
                'url' => $request->fullUrl(),
            ]);

            if ($request->expectsJson()) {
                return response()->json(['error' => $e->getMessage()], 422);
            }
            return back()->with('error', $e->getMessage());
        });

        $this->renderable(function (\Throwable $e, Request $request) {
            // unexpected error → full stack trace logged
            Log::error($e, [
                'user_id' => Auth::id(),
                'url' => $request->fullUrl(),
            ]);

            if ($request->expectsJson()) {
                return response()->json(['error' => 'Internal server error'], 500);
            }

            if (app()->environment('production')) {
                return back()->with('error', 'Ocorreu um erro inesperado.');
            }

            return null; // let Laravel default debug page show in dev
        });
    }
}
