<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CarritoService
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.carrito.url');
    }

    public function obtenerCarrito($idCliente)
    {
        $response = Http::get("{$this->apiUrl}/{$idCliente}");

        return $response->successful()
            ? $response->json()
            : [];
    }

    public function agregarAlCarrito($data)
    {
        $response = Http::post($this->apiUrl, $data);

        return $response->successful();
    }

    public function vaciarCarrito($idCliente)
    {
        $response = Http::delete("{$this->apiUrl}/{$idCliente}");

        return $response->successful();
    }
}
