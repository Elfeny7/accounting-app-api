<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\JwtMiddleware;
use App\Helper\ApiResponse;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'jwt' => JwtMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                if ($e instanceof \Illuminate\Validation\ValidationException) {
                    return ApiResponse::validationError($e->errors());
                }
                if ($e instanceof \App\Exceptions\InvalidCredentialsException) {
                    return ApiResponse::error($e, 'Invalid email or password', 401);
                }
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                    return ApiResponse::error($e, 'Token blacklisted', 401);
                }
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                    return ApiResponse::error($e, 'Token expired', 401);
                }
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                    return ApiResponse::error($e, 'Token invalid', 401);
                }
                if ($e instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
                    return ApiResponse::error($e, 'Token not provided', 400);
                }
                return ApiResponse::error($e);
            }
        });
    })->create();
