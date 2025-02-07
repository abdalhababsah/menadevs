<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AttempterMiddleware;
use App\Http\Middleware\ReviewerMiddleware;
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
        // Register your custom route middleware aliases:
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'reviewer' => ReviewerMiddleware::class,
            'attempter' => AttempterMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Throwable $exception) {
            if (method_exists($exception, 'getStatusCode') && $exception->getStatusCode() === 403) {
                return redirect()->route('error.403');
            }
            return null;
        });
    })
    ->create();