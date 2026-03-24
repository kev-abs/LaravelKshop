<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CarritoController
{
    public function index()
    {
        $idCliente = session('id_cliente');

        $response = Http::get("http://localhost:8080/carrito/$idCliente");

        $carrito = $response->json();

        return view('ventas.carrito.index', compact('carrito'));
    }

    public function store(Request $request)
    {
        $idCliente = session('id_cliente');

        Http::asJson()->post("http://localhost:8080/carrito", [
            "idCliente" => $idCliente,
            "idProducto" => (int) $request->idProducto,
            "cantidad" => (int) $request->cantidad
        ]);

        return redirect()->route('ventas.carrito.index');
    }
    
    public function updateCantidad(Request $request)
    {
        $idCliente = session('id_cliente');

        Http::asJson()->put("http://localhost:8080/carrito/cantidad", [
            "idCliente" => $idCliente,
            "idProducto" => (int) $request->idProducto,
            "cantidad" => (int) $request->cantidad
        ]);

        return redirect()->route('ventas.carrito.index');
    }

    public function eliminar(Request $request)
    {
        $idCliente = session('id_cliente');

        Http::asJson()->delete("http://localhost:8080/carrito/producto", [
            "idCliente" => $idCliente,
            "idProducto" => (int) $request->idProducto
        ]);

        return redirect()->route('ventas.carrito.index');
    }

public function checkout(Request $request)
{
    $idCliente = session('id_cliente');

    Http::post("http://35.175.5.116:8080/carrito/checkout", [
        "idCliente" => $idCliente,
        "direccion" => $request->direccion,
        "ciudad" => $request->ciudad,
        "metodoPago" => $request->metodoPago
    ]);

    return redirect()->route('checkout.historial');
}

    public function confirmar()
{
    $idCliente = session('id_cliente');

    $response = Http::get("http://35.175.5.116:8080/carrito/$idCliente");

    $carrito = $response->json();

    return view('ventas.carrito.confirmar', compact('carrito'));
}

}
