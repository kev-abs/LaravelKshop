<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class ProductoCategoriaController
{
    public function PorCategoria()
{
    $response = Http::get('http://localhost:8080/api/producto-categoria/por-categoria');

    if (!$response->successful()) {
        return back()->with('error', 'No se pudieron cargar las categorías');
    }

    $categorias = $response->json();

    return view('productos.productosPorCategoria', compact('categorias'));
}
}