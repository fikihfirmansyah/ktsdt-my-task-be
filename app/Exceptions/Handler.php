<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    // ...

    public function render($request, Throwable $exception)
    {
        if ($request->expectsJson()) {
            // Customize JSON response for specific exceptions
            return $this->handleApiException($request, $exception);
        }

        return parent::render($request, $exception);
    }

    protected function handleApiException($request, Throwable $exception)
    {
        // Default status code
        $statusCode = 500;
        $message = 'Server Error';

        // Handle specific exceptions
        if ($this->isHttpException($exception)) {
            $statusCode = $exception->getStatusCode();
            $message = $exception->getMessage() ?: $message;
        }

        // Customize error response
        return response()->json([
            'error' => true,
            'message' => $message,
            'status_code' => $statusCode,
        ], $statusCode);
    }
}
