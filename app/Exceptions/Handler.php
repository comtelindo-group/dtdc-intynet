<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
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
    public function render($request, Throwable $exception)
    {
        if ($request->ajax() || $request->expectsJson() || $request->is('api/*')) {
            if ($exception instanceof HttpException) {
                return response()->json([
                    "code" => $exception->getStatusCode(),
                    "status" => "fail",
                    "message" => $exception->getMessage(),
                ], $exception->getStatusCode());
            }

            if ($exception instanceof ValidationException) {
                return response()->json([
                    "code" => 400,
                    "status" => "fail",
                    "message" => $exception->validator->errors()->first(),
                ], 400);
            }

            if ($exception instanceof TokenMismatchException) {
                return response()->json([
                    "code" => 419,
                    "status" => "fail",
                    "message" => "Sesi tidak tervalidasi, silahkan refresh halaman",
                ], 419);
            }

            if ($exception instanceof AuthenticationException) {
                return response()->json([
                    "code" => 401,
                    "status" => "fail",
                    "message" => "Sesi tidak valid, silahkan login kembali",
                ], 401);
            }

            Log::error($exception);

            return response()->json([
                'code' => 500,
                'status' => 'fail',
                'message' => "Something Went Wrong, Please Contact Administrator",
            ], 500);
        }

        return parent::render($request, $exception);
    }
}
