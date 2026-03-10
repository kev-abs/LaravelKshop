<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\CuponController;

class CarritoController
{
    public function index()
    {
        $idCliente = session('id_cliente');

        $response = Http::get("http://localhost:8080/carrito/$idCliente");

        $carrito = $response->json();

        // Traer cupones disponibles usando directamente el controlador
        $cuponController = new CuponController();
        $cuponesResponse = $cuponController->apiMisCupones($idCliente);
        $cupones = $cuponesResponse->getData(true);

        if (!is_array($cupones)) { $cupones = []; }


        return view('ventas.carrito.index', compact('carrito', 'cupones'));
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

    Http::post("http://localhost:8080/carrito/checkout", [
        "idCliente" => $idCliente,
        "direccion" => $request->direccion,
        "ciudad" => $request->ciudad,
        "metodoPago" => $request->metodoPago
    ]);

    return redirect()->route('checkout.historial');
}

    public function confirmar(Request $request)
{
    $idCliente = session('id_cliente');

    $response = Http::get("http://localhost:8080/carrito/$idCliente");
    $carrito = $response->json();

    // Cupón y descuento
    $idCupon = $request->query('idCuponClienteAsignado'); 
    $descuento = $request->query('descuento', 0); // default 0

    // Aplicar descuento al subtotal
    if($descuento > 0){
        $carrito['subtotal'] = $carrito['subtotal'] * (1 - $descuento/100);

        // También puedes guardar el subtotal descontado en cada item si quieres mostrarlo
        foreach($carrito['items'] as &$item){
            $item['total'] = $item['total'] * (1 - $descuento/100);
        }
    }

    $idCupon = $request->query('idCuponClienteAsignado'); // cupón pasado desde index.blade.php

    return view('ventas.carrito.confirmar', compact('carrito', 'idCupon', 'descuento'));
}

}
