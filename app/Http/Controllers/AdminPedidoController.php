<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AdminPedidoController extends Controller
{
    public function index()
    {
        $response = Http::get("http://localhost:8080/pedido"); 

        $pedidos = $response->json();

        return view('admin.pedidos.index', compact('pedidos'));
    }
}
