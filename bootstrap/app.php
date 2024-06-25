<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        // web: __DIR__.'/../routes/web.php', (Optional for web routes)
        api: __DIR__ . '/../routes/api.php', // Specify your API routes
        commands: __DIR__ . '/../routes/console.php', // Specify your console routes
        health: '/up', // Optional health check route
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Add global middleware for error handling (optional)
        // $middleware->push(JsonException::class); // Replace with your custom middleware class
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // $exceptions->renderable(function (\Throwable $throwable, Request $request) {
        //     $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        //     if ($throwable instanceof HttpException) {
        //         $status = $throwable->getStatusCode();
        //     }

        //     return response()->json([
        //         'message' => $throwable->getMessage(),
        //         'exception' => get_class($throwable), // Optional: Include exception class for debugging
        //         'code' => $status,
        //     ], $status);
        // });
    })
    ->create();
