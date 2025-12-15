<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class CheckoutService
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.checkout.url');
    }

    public function confirmarCompra(array $data)
    {
        $response = Http::post($this->apiUrl, $data);

        return $response->successful()
            ? $response->json()
            : false;
    }
}
