<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class CheckoutService
{
    private string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.checkout.url');
    }

    public function confirmarCompra(array $data): bool
    {
        $response = Http::post($this->apiUrl, $data);

        return $response->successful();
    }

        public function obtenerHistorial($idCliente)
    {
        $response = Http::get("{$this->apiUrl}/cliente/{$idCliente}");

        return $response->successful()
            ? $response->json()
            : [];
    }
}

