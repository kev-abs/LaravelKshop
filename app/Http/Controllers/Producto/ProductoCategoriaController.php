<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Support\Facades\Http;

class ProductoCategoriaController
{
    public function PorCategoria()
{
    $response = Http::get('http://35.175.5.116:8080/api/producto-categoria/por-categoria');

    if (!$response->successful()) {
        return back()->with('error', 'No se pudieron cargar las categorías');
    }

    $categorias = $response->json();

    return view('productos.productosPorCategoria', compact('categorias'));
}
}