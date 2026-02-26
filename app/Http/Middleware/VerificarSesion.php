<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VerificarSesion
{
    public function handle(Request $request, Closure $next)
    {
        // Si no hay sesión activa
        if (!Session::has('rol')) {
            return redirect()->route('login');
        }

        $response = $next($request);

        // Evita que el navegador guarde la página en caché
        return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma','no-cache')
                        ->header('Expires','Sat, 01 Jan 1990 00:00:00 GMT');
    }
}