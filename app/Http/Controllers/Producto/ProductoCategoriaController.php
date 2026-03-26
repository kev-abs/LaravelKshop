<?php

namespace App\Http\Controllers\Producto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductoCategoriaController
{
    public function PorCategoria(Request $request)
    {
        $response = Http::get('http://localhost:8080/api/producto-categoria/por-categoria');

        if (!$response->successful()) {
            return back()->with('error', 'No se pudieron cargar las categorías');
        }

        $categorias = $response->json();
        $genero     = $request->query('genero');

        if (!empty($genero)) {
            $categorias = collect($categorias)->map(function($cat) use ($genero) {
                $cat['productos'] = collect($cat['productos'] ?? [])
                    ->filter(fn($p) => strtolower($p['genero'] ?? '') === strtolower($genero))
                    ->values()
                    ->toArray();
                return $cat;
            })
            ->filter(fn($cat) => count($cat['productos']) > 0)
            ->values()
            ->toArray();
        }

        return view('productos.productosPorCategoria', compact('categorias', 'genero'));
    }
}