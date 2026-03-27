<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
class VerificarSesion
{
    public function handle(Request $request, Closure $next)
    {
        //  Verifica si hay sesión activa
        if (!Session::has('rol')) {
            return redirect()->route('login');
        }

        $response = $next($request);

        // Si es una descarga (Excel, PDF, archivos), NO modificar headers
        if ($response instanceof BinaryFileResponse) {
            return $response;
        }

        //  Evita caché en páginas normales
        return $response->header('Cache-Control','no-cache, no-store, max-age=0, must-revalidate')
                        ->header('Pragma','no-cache')
                        ->header('Expires','Sat, 01 Jan 1990 00:00:00 GMT');
    }
}