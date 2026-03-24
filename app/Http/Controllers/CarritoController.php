<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\CuponController;
use Illuminate\Support\Facades\DB;

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

    $idCuponCliente      = $request->input('idCuponClienteAsignado'); // este es ID_Cupon
    $descuento           = 0;
    $porcentajeDescuento = 0;

    if ($idCuponCliente) {
        $cupon = DB::table('cupon_cliente')
            ->join('cupon', 'cupon_cliente.ID_Cupon', '=', 'cupon.ID_Cupon')
            ->where('cupon_cliente.ID_Cupon', $idCuponCliente)    // ← corregido
            ->where('cupon_cliente.ID_Cliente', session('id_cliente'))
            ->where('cupon_cliente.Usado', 0)
            ->select('cupon.descuento')
            ->first();

        if ($cupon) {
            $porcentajeDescuento = $cupon->descuento;

            $carritoResponse = Http::get("http://localhost:8080/carrito/$idCliente");
            $carrito         = $carritoResponse->json();
            $subtotal        = $carrito['subtotal'];
            $descuento       = $subtotal * $porcentajeDescuento / 100;

            // Marcar como usado
            DB::table('cupon_cliente')
                ->where('ID_Cupon', $idCuponCliente)        // ← corregido
                ->where('ID_Cliente', session('id_cliente'))
                ->update(['Usado' => 1]);
        }
    }

       $response = Http::asJson()->post("http://localhost:8080/carrito/checkout", [
        "idCliente"           => $idCliente,
        "direccion"           => $request->direccion,
        "ciudad"              => $request->ciudad,
        "metodoPago"          => $request->metodoPago,
        "descuento"           => $descuento,
        "porcentajeDescuento" => (int) $porcentajeDescuento
    ]);

    if (!$response->successful()) {
        return back()->with('error', 'Error: ' . $response->body());
    }

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

// Aplicar cupón a la sesión
public function aplicarCupon(Request $request)
{
    $cuponCliente = DB::table('cupon_cliente')
        ->join('cupones', 'cupon_cliente.ID_Cupon', '=', 'cupones.ID_Cupon')
        ->where('cupon_cliente.ID_Cupon', $request->ID_CuponCliente)  // ← ID_Cupon
        ->where('cupon_cliente.ID_Cliente', session('id_cliente'))
        ->where('cupon_cliente.Usado', 0)
        ->select('cupon_cliente.ID_Cupon', 'cupones.codigo', 'cupones.descuento')
        ->first();

    if (!$cuponCliente) {
        return back()->with('error', 'Cupón no válido.');
    }

    session([
        'cupon_aplicado'  => true,
        'cupon_id'        => $cuponCliente->ID_Cupon,   // ← ID_Cupon
        'cupon_codigo'    => $cuponCliente->codigo,
        'cupon_descuento' => $cuponCliente->descuento,
    ]);

    return back()->with('success', 'Cupón aplicado correctamente.');
}

// Quitar cupón de la sesión
public function quitarCupon()
{
    session()->forget(['cupon_aplicado', 'cupon_id', 'cupon_codigo', 'cupon_descuento']);
    return back();
}


}
