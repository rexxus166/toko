<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Mengecualikan CSRF untuk route tertentu
        $middleware->validateCsrfTokens(except: [
            'https://5147-202-46-68-199.ngrok-free.app/checkout/callback',
            'checkout/callback',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
