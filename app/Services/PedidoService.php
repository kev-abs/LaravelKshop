<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PedidoService
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.pedidos.url');
    }

    public function obtenerPedidos()
    {
        $response = Http::get($this->apiUrl);

        return $response->successful()
            ? $response->json()
            : false;
    }

        public function agregarPedidos($data)
    {
        $response = Http::post($this->apiUrl, $data);
        return $response->successful();
    }

        public function eliminarPedido($id)
    {
        $response = Http::delete("{$this->apiUrl}/{$id}");
        return $response->successful();
    }

}
