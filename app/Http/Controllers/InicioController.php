<?php

namespace App\Http\Controllers;
use App\Models\producto\Producto;

class InicioController
{
    public function index()
    {
        $productosDestacados = Producto::orderBy('ID_Producto', 'desc')
            ->take(8)
            ->get();

        return view('inicio', compact('productosDestacados'));
    }
}
