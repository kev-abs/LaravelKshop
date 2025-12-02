<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
class ProductoService
{
    private $apiUrl = "http://localhost:8080/productos";

    private $jwtToken = "";


    /* -------------------------------------------
       GET - Obtener producto por ID
    -------------------------------------------- */
    public function obtenerProductoPorId($id)
    {
        $response = Http::withToken($this->jwtToken)
            ->get("{$this->apiUrl}/{$id}");

        if ($response->failed()) {
            return ["success" => false, "error" => "No se pudo obtener el producto"];
        }

        return ["success" => true, "data" => $response->json()];
    }


    /* -------------------------------------------
       GET - Obtener todos los productos
    -------------------------------------------- */
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


    /* -------------------------------------------
       POST - Agregar producto
    -------------------------------------------- */
    public function agregarProducto($nombre, $descripcion, $precio, $stock, $idProveedor, $imagen = null, $estado = null)
    {
        $datos = [
            "nombre"      => $nombre,
            "descripcion" => $descripcion,
            "precio"      => $precio,
            "stock"       => $stock,
            "idProveedor" => $idProveedor,
            "estado"      => $estado
        ];

        // Si envían imagen, se adjunta
        if ($imagen) {
            $datos["imagen"] = fopen($imagen->getRealPath(), 'r');
        }

        $response = Http::withToken($this->jwtToken)
            ->attach('imagen', $imagen ? fopen($imagen->getRealPath(), 'r') : null)
            ->post("{$this->apiUrl}/insertar", $datos);

        if ($response->failed()) {
            return ["success" => false, "error" => "Error al agregar producto"];
        }

        return ["success" => true, "data" => $response->json()];
    }


    /* -------------------------------------------
       PUT - Actualizar producto
    -------------------------------------------- */
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
    $datos = [
        "nombre"        => $nombre,
        "descripcion"   => $descripcion,
        "precio"        => $precio,
        "stock"         => $stock,
        "id_Proveedor"   => $idProveedor,
        "estado"        => $estado,
        "imagen_actual" => $imagenActual,  
        "_method"       => "PUT"            
    ];

    $url = "{$this->apiUrl}/actualizar/{$id}";

    // Preparar request con token
    $request = Http::withToken($this->jwtToken);

    // Si se subió una nueva imagen → adjuntarla
    if ($imagen) {
        $request = $request->attach(
            'imagen',
            fopen($imagen->getRealPath(), 'r'),
            $imagen->getClientOriginalName()
        );
    }

    // Enviar como POST (para permitir multipart/form-data)
    $response = $request->post($url, $datos);

    if ($response->failed()) {
        return ["success" => false, "error" => "Error al actualizar"];
    }

    return ["success" => true, "data" => $response->json()];
}

}