<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

use App\Http\Resources\ApiResponseErrorResource;

class ErrorHandler
{
    public function register($exceptions)
    {
        $exceptions->renderable(function (Throwable $e, $request) {
            // Log the error
            Log::error(sprintf(
                "[%s] %s in %s:%d\nStack trace:\n%s",
                get_class($e),
                $e->getMessage(),
                $e->getFile(),
                (int) $e->getLine(),
                $e->getTraceAsString()
            ));

            if ($request->expectsJson() || $request->is('api/*')) {
                $code = 500;
                $message = 'Something went wrong (Please check logs)';
                $errors = null;

                if ($e instanceof ValidationException) {
                    $code = 422;
                    $message = 'Validation failed';
                    $errors = $e->errors();
                } elseif ($e instanceof AuthenticationException) {
                    $code = 401;
                    $message = 'Unauthenticated.';
                } elseif ($e instanceof NotFoundHttpException) {
                    $code = 404;
                    $message = 'Route not found.';
                } elseif ($e instanceof MethodNotAllowedHttpException) {
                    $code = 405;
                    $message = 'Method not allowed.';
                }

                return (new ApiResponseErrorResource([
                    'code' => $code,
                    'message' => $message,
                    'errors' => $errors,
                ]))->response()->setStatusCode($code);
            }

            return null;
        });
    }
}
