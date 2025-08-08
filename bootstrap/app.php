<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Exceptions\ErrorHandler;
use App\Http\Middleware\CheckAdminPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            'check.permission' => CheckAdminPermissionMiddleware::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $handler = new ErrorHandler();
        $handler->register($exceptions);
    })->create();
