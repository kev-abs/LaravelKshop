<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductoService;

class ClienteController
{
    private $productoService;

    

    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    public function tienda()
{
    $categorias = $this->productoService->obtenerCategorias();

    // Validación para evitar el error
    if (!isset($categorias["success"]) || !$categorias["success"]) {
        return back()->with(
            "error",
            $categorias["error"] ?? "No se pudieron cargar las categorías"
        );
    }

    return view('cliente.tienda', [
        "categorias" => $categorias["data"]
    ]);
}

public function panel()
{
    // Obtener productos
    $productos = $this->productoService->obtenerProductos();

    // Crear categorías "virtuales" desde los productos si la API no tiene categorías
    $categoria = collect($productos['data'])->pluck('id_Proveedor')->unique()->map(function($id){
        return [
            'id' => $id,
            'nombre' => "Proveedor $id"
        ];
    })->toArray();

    return view('Usuario.cliente.panelCliente', [
        'productos' => $productos['data'],
        'categorias' => $categoria
    ]);
}



public function productosCategoria($id)
{
    $productos = $this->productoService->productosPorCategoria($id);
    return view('cliente.productos', [
        "productos" => $productos["data"]
    ]);
}

}
