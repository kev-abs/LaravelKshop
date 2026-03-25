<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminEnvioController
{
    public function index()
    {
        $response = Http::get("http://35.175.5.116:8080/envio");
        $envios = $response->json();

        return view('admin.envios.index', compact('envios'));
    }

    public function cambiarEstado(Request $request, $id)
    {
        $estado = $request->estado;

        Http::put("http://35.175.5.116:8080/envio/$id/estado/$estado");

        return back()->with('success', 'Estado actualizado correctamente');
    }
}