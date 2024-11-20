<?php

use App\Enums\AbstractEnum;
use App\Util\StringUtil;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        apiPrefix: AbstractEnum::API_ROUTE_PREFIX
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e) {
            if($e instanceof ValidationException) {
                return response()->json(
                        ['message' => StringUtil::getValidationErrorsMessages($e->errors())],
                        $e->status);
            }
        });
    })->create();
