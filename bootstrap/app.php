<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

try {
    return Application::configure(basePath: dirname(__DIR__))
        ->withRouting(
            web: __DIR__.'/../routes/web.php',
            commands: __DIR__.'/../routes/console.php',
            health: '/up',
        )
        ->withMiddleware(function (Middleware $middleware): void {
            //
        })
        ->withExceptions(function (Exceptions $exceptions): void {
            $exceptions->reportable(function (\Throwable $e) {
                file_put_contents('php://stderr', "LARAVEL REPORTED ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n");
            });
            $exceptions->shouldRenderJsonWhen(
                fn (Request $request) => $request->is('api/*'),
            );
        })->create();
} catch (\Throwable $e) {
    file_put_contents('php://stderr', "CRITICAL BOOT ERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n");
    throw $e;
}
