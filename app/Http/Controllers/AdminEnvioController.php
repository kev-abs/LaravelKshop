<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AdminEnvioController
{
    public function index()
    {
        $response = Http::get("http://localhost:8080/envio"); 
        

        $envios = $response->json();

        return view('admin.envios.index', compact('envios'));
    }
}
