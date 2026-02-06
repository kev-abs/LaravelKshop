<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarCliente
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('id_cliente')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}

