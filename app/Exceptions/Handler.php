<?php

namespace App\Exceptions;

use App\Http\Resources\ApiResponseErrorResource;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;


class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
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
            $message = "something wen wrong";
            $errors = null;

            if ($e instanceof ValidationException) {
                $code = 422;
                $message = 'Validation failed';
                $errors = $e->errors();
            } elseif ($e instanceof AuthenticationException) {
                $code = 401;
                $message = 'Unauthenticated.';
            }elseif ($e instanceof AuthorizationException) {
                $code = 403;
                $message = 'Unauthorized.';
            } elseif ($e instanceof NotFoundHttpException) {
                $code = 404;
                $message = 'Route not found.';
            } elseif ($e instanceof MethodNotAllowedHttpException) {
                $code = 405;
                $message = 'Method not allowed.';
            }

            return (new ApiResponseErrorResource([
                'code'    => $code,
                'message' => $message,
                'errors'  => $errors,
            ]))->response()->setStatusCode($code);
        }

        return parent::render($request, $e);
    }
}
