<?php

namespace App\Http\Controllers;

use App\Models\producto\Producto;

class InicioController
{
    public function index()
    {
        $masVistos = Producto::orderBy('ID_Producto', 'desc')
            ->take(5)
            ->get();

        $tendencias = Producto::whereNotIn('ID_Producto', $masVistos->pluck('ID_Producto'))
            ->orderBy('ID_Producto', 'desc')
            ->take(10)
            ->get();

        $recomendados = Producto::whereNotIn('ID_Producto',
                $masVistos->pluck('ID_Producto')
                    ->merge($tendencias->pluck('ID_Producto'))
            )
            ->inRandomOrder()
            ->take(8)
            ->get();

        return view('inicio', compact(
            'masVistos',
            'tendencias',
            'recomendados'
        ));
    }
}