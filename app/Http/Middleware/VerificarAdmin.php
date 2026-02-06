<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerificarAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('rol') || session('rol') !== 'administrador') {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
