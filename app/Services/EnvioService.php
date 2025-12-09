<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EnvioService
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.envios.url');
    }

    public function obtenerEnvios()
    {
        $response = Http::get($this->apiUrl);

        return $response->successful()
            ? $response->json()
            : false;
    }

    public function agregarEnvios($data)
    {
        $response = Http::post($this->apiUrl, $data);
        return $response->successful();
    }


    public function eliminarEnvio($id)
    {
        $response = Http::delete("{$this->apiUrl}/{$id}");
        return $response->successful();
    }
}
