<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminPedidoController

{
    public function index()
    {
        $response = Http::get("http://localhost:8080/pedido"); 
        $pedidos = $response->json();

        return view('admin.pedidos.index', compact('pedidos'));
    }

    public function cambiarEstado(Request $request, $id)
    {
        $estado = $request->estado;

        Http::put("http://localhost:8080/pedido/$id/estado/$estado");

        return back()->with('success', 'Estado actualizado correctamente');
    }
}
