<?php

use Illuminate\Foundation\Application;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Exceptions\DocumentoInvalidoException;
use App\Exceptions\TelefonoInvalidoException;
use App\Exceptions\CorreoInvalidoException;
use App\Exceptions\ContrasenaInvalidaException;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\VerificarSesion;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            'cliente' => \App\Http\Middleware\VerificarCliente::class,
            'admin' => \App\Http\Middleware\VerificarAdmin::class,
            'verificar.sesion' => VerificarSesion::class,
        ]);

    })

    ->withExceptions(function (Exceptions $exceptions): void {

        $exceptions->render(function (DocumentoInvalidoException $e, $request) {
            return response()->json([
                'success' => false,
                'type' => 'DOCUMENTO_INVALIDO',
                'message' => $e->getMessage()
            ], 422);
        });

        $exceptions->render(function (TelefonoInvalidoException $e, $request) {
            return response()->json([
                'success' => false,
                'type' => 'TELEFONO_INVALIDO',
                'message' => $e->getMessage()
            ], 422);
        });

        $exceptions->render(function (CorreoInvalidoException $e, $request) {
            return response()->json([
                'success' => false,
                'type' => 'CORREO_INVALIDO',
                'message' => $e->getMessage()
            ], 422);
        });

        $exceptions->render(function (ContrasenaInvalidaException $e, $request) {
            return response()->json([
                'success' => false,
                'type' => 'CONTRASENA_INVALIDA',
                'message' => $e->getMessage()
            ], 422);
        });

        /*
        |--------------------------------------------------------------------------
        | VALIDATION ERROR
        |--------------------------------------------------------------------------
        */
        $exceptions->render(function (ValidationException $e, $request) {

            return response()->json([
                'success' => false,
                'type' => 'VALIDATION_ERROR',
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);

        });


        /*
        |--------------------------------------------------------------------------
        | DATABASE ERROR
        |--------------------------------------------------------------------------
        */
        $exceptions->render(function (QueryException $e, $request) {

            return response()->json([
                'success' => false,
                'type' => 'DATABASE_ERROR',
                'message' => $e->getMessage(),
            ], 500);

        });


        /*
        |--------------------------------------------------------------------------
        | ROUTE NOT FOUND
        |--------------------------------------------------------------------------
        */
        $exceptions->render(function (NotFoundHttpException $e, $request) {

            return response()->json([
                'success' => false,
                'type' => 'NOT_FOUND',
                'message' => 'Ruta no encontrada'
            ], 404);

        });


        /*
        |--------------------------------------------------------------------------
        | METHOD NOT ALLOWED
        |--------------------------------------------------------------------------
        */
        $exceptions->render(function (MethodNotAllowedHttpException $e, $request) {

            return response()->json([
                'success' => false,
                'type' => 'METHOD_NOT_ALLOWED',
                'message' => 'Método HTTP no permitido'
            ], 405);

        });


        /*
        |--------------------------------------------------------------------------
        | HTTP ERROR GENERAL
        |--------------------------------------------------------------------------
        */
        $exceptions->render(function (HttpException $e, $request) {

            return response()->json([
                'success' => false,
                'type' => 'HTTP_ERROR',
                'message' => $e->getMessage()
            ], $e->getStatusCode());

        });


        /*
        |--------------------------------------------------------------------------
        | ERROR GENERAL (CUALQUIER ERROR)
        |--------------------------------------------------------------------------
        */
        $exceptions->render(function (Throwable $e, $request) {

            return response()->json([
                'success' => false,
                'type' => 'SERVER_ERROR',
                'message' => 'Error interno del servidor',
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);

        });

    })->create();