<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
class ProductoService
{
    private $apiUrl = "http://localhost:8080/productos";

    private $jwtToken = "";


    /*GET - Obtener producto por ID*/
    public function obtenerProductoPorId($id)
    {
        $response = Http::withToken($this->jwtToken)
            ->get("{$this->apiUrl}/{$id}");

        if ($response->failed()) {
            return ["success" => false, "error" => "No se pudo obtener el producto"];
        }

        return ["success" => true, "data" => $response->json()];
    }


    /*GET - Obtener todos los productos */
    public function obtenerProductos()
    {
        $response = Http::withToken($this->jwtToken)
            ->get($this->apiUrl);

        if ($response->failed()) {
            return ["success" => false, "error" => "No se pudo obtener los productos"];
        }

        $productos = collect($response->json())
            ->map(function ($fila) {
                return [
                    'id_Producto' => $fila['id_Producto'] ?? null,
                    'nombre'      => $fila['nombre'] ?? null,
                    'descripcion' => $fila['descripcion'] ?? null,
                    'precio'      => $fila['precio'] ?? null,
                    'stock'       => $fila['stock'] ?? null,
                    'id_Proveedor'=> $fila['id_Proveedor'] ?? null,
                    'imagen'      => $fila['imagen'] ?? null,
                    'estado'      => $fila['estado'] ?? null,
                ];
            })
            ->toArray();

        return ["success" => true, "data" => $productos];
    }


    /*POST - Agregar producto */
    public function agregarProducto($nombre, $descripcion, $precio, $stock, $idProveedor, $imagen = null, $estado = null)
{
    // Iniciamos request como multipart
    $request = Http::withToken($this->jwtToken)->asMultipart();

    // Adjuntar datos (SIEMPRE van como strings)
    $request = $request->attach('nombre', $nombre);
    $request = $request->attach('descripcion', $descripcion);
    $request = $request->attach('precio', $precio);
    $request = $request->attach('stock', $stock);
    $request = $request->attach('idProveedor', $idProveedor);
    $request = $request->attach('estado', $estado);

    // Adjuntar imagen solo si viene
    if ($imagen) {
        $request = $request->attach(
            'imagen',
            file_get_contents($imagen->getRealPath()),
            $imagen->getClientOriginalName()
        );
    }

    // Enviar request
    $response = $request->post("{$this->apiUrl}/insertar");

    if ($response->failed()) {
        return ["success" => false, "error" => "Error al agregar producto"];
    }

    return ["success" => true, "data" => $response->json()];
}



    /*PUT - Actualizar producto*/
    public function actualizarProductos(
    $id,
    $nombre,
    $descripcion,
    $precio,
    $stock,
    $idProveedor,
    $imagen,
    $imagenActual,
    $estado
) {
    $url = "{$this->apiUrl}/actualizar/{$id}";

    // construir multipart para Guzzle
    $multipart = [
        ['name' => 'nombre', 'contents' => (string) $nombre],
        ['name' => 'descripcion', 'contents' => (string) $descripcion],
        ['name' => 'precio', 'contents' => (string) $precio],
        ['name' => 'stock', 'contents' => (string) $stock],
        ['name' => 'idProveedor', 'contents' => (string) $idProveedor], // coincide con @RequestParam("idProveedor")
        ['name' => 'estado', 'contents' => (string) $estado],
        ['name' => 'imagen_actual', 'contents' => (string) $imagenActual],
    ];

    if ($imagen) {
        // agregar archivo como resource
        $multipart[] = [
            'name'     => 'imagen',
            'contents' => fopen($imagen->getRealPath(), 'r'),
            'filename' => $imagen->getClientOriginalName(),
        ];
    }

    // Enviar PUT real con multipart
    $response = Http::withToken($this->jwtToken)
        ->withOptions(['multipart' => $multipart])
        ->send('PUT', $url);

    // Depuración / manejo de errores más útil
    if ($response->failed()) {
        // Devuelve el status y body para que puedas ver el porqué la API rechazó
        $status = $response->status();
        $body = $response->body();
        return ["success" => false, "error" => "Error al actualizar: HTTP {$status} - {$body}"];
    }

    // Si la API responde OK con JSON
    try {
        $json = $response->json();
    } catch (\Throwable $e) {
        $json = null;
    }

    return ["success" => true, "data" => $json ?? $response->body()];
}
public function eliminarProducto($id)
{
    $url = "{$this->apiUrl}/eliminar/{$id}";

    $response = Http::withToken($this->jwtToken)->delete($url);

    if ($response->failed()) {
        return ["success" => false, "error" => "Error al eliminar"];
    }

    return ["success" => true];
}
// Obtener categorías desde API 
public function obtenerCategorias()
{
    try {
        $response = Http::get('http://localhost:8080/api/categorias');

        if ($response->successful()) {
            return [
                'success' => true,
                'data' => $response->json()
            ];
        }

        return ['success' => false, 'data' => []];

    } catch (\Exception $e) {
        return ['success' => false, 'data' => []];
    }
}

public function asignarProductoCategoria($idProducto, $idCategoria)
{
    $response = Http::post(
        $this->apiUrl . '/producto-categoria/asignar',
        [
            'idProducto'  => $idProducto,
            'idCategoria' => $idCategoria
        ]
    );

    if ($response->failed()) {
        return ['success' => false];
    }

    return ['success' => true];
}

public function obtenerCategoriasConProductos()
{
    $response = Http::get('http://localhost:8080/api/producto-categoria/con-productos');

    if ($response->failed()) {
        return [
            'success' => false,
            'data' => []
        ];
    }

    return [
        'success' => true,
        'data' => $response->json()
    ];
}


}