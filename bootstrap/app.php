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
        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\EnsureUserIsAdmin::class,
            'isOrdinary' => \App\Http\Middleware\EnsureUserIsOrdinary::class,
        ]);
        
        // Other global middleware or groups can be configured here
        // For example, if you had web group middleware to re-add:
        // $middleware->web(append: [
        //     \App\Http\Middleware\EncryptCookies::class,
        //     // ... other web middleware
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
