<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Database\QueryException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof MethodNotAllowedHttpException) {

            return response()->json(['message' => 'Method Not Allowed', 'code' => $exception->getStatusCode()], $exception->getStatusCode());
        }

        if ($exception instanceof HttpException) {

            return response()->json(['message' => $exception->getMessage(), 'code' => $exception->getStatusCode()], $exception->getStatusCode());
        }

        if ($exception instanceof QueryException) {
            $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;
            return response()->json(['message' => 'Unexpected  Error QueryException', 'code' => $statusCode], $statusCode);
        }

        if ($exception instanceof NotFoundHttpException) {

            return response()->json(['message' => $exception->getMessage(), 'code' => $exception->getStatusCode()], $exception->getStatusCode());
        }

        // token expired
        if ($exception instanceof TokenExpiredException) {
            return response()->json([
                'message' => 'token_expired',
                'code' => 403
            ], 403);
        }

        // token invalid
        if ($exception instanceof TokenInvalidException) {
            return response()->json([
                'message'   => 'token_invalid',
                'code'      => 403
            ], 403);
        }

        // token not found
        if ($exception instanceof JWTException) {
            return response()->json([
                'message'   => 'token_absent',
                'code'      => 403
            ], 403);
        }

        return parent::render($request, $exception);
    }
}
