<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
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
        //
    })->create();