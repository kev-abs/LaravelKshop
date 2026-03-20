<?php

namespace App\Http\Controllers;
use App\Models\producto\Producto;
use Illuminate\Support\Facades\DB;

class InicioController
{
    public function index()
    {
        $productosDestacados = Producto::orderBy('ID_Producto', 'desc')
            ->take(8)
            ->get();

        $productos = DB::table('producto')
            ->inRandomOrder()
            ->take(20)
            ->get();

        $productos2 = DB::table('producto')
            ->inRandomOrder()
            ->take(8)
            ->get();

        return view('inicio', compact(
            'productosDestacados',
            'productos',
            'productos2'
        ));
    }
}
