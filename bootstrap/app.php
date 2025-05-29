<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__.'/../routes/web.php', // Main web routes
            ...array_map(
                fn($module) => app_path("Modules/{$module}/Routes/web.php"),
                ['User', 'Product', 'Order', 'Payment', 'Shipment'] // Your modules
            )
        ],
        api: [
            __DIR__.'/../routes/api.php', // Main api routes
            ...array_map(
                fn($module) => app_path("Modules/{$module}/Routes/api.php"),
                ['User', 'Product', 'Order', 'Payment', 'Shipment'] // Your modules
            )
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
