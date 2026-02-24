<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;


class PedidoController extends Controller
{
    public function historial()
    {
        $idCliente = session('id_cliente');

        $response = Http::get("http://localhost:8080/pedido/cliente/$idCliente");

        $pedidos = $response->json();

        return view('ventas.pedidos.index', compact('pedidos'));
    }

public function detalle($id)
{
    $idCliente = session('id_cliente');

    // Traer pedido
    $pedidoResponse = Http::get("http://localhost:8080/pedido/$id");
    $pedido = $pedidoResponse->json();

    // Seguridad
    if (!$pedido || $pedido['idCliente'] != $idCliente) {
        abort(403);
    }

    // Traer detalle productos
    $detalleResponse = Http::get("http://localhost:8080/pedido/$id/detalle");
    $detalles = $detalleResponse->json();

    return view('ventas.pedidos.detalle', compact('pedido', 'detalles'));
}
public function comprobante($id)
{
    $pedido = Http::get("http://localhost:8080/pedido/$id")->json();
    $detalles = Http::get("http://localhost:8080/pedido/$id/detalle")->json();

    return view('ventas.pedidos.comprobante', compact('pedido','detalles'));
}

public function comprobantePdf($id)
{
    $idCliente = session('id_cliente');

    $pedido = Http::get("http://localhost:8080/pedido/$id")->json();
    $detalles = Http::get("http://localhost:8080/pedido/$id/detalle")->json();

    // seguridad
    if (!$pedido || $pedido['idCliente'] != $idCliente) {
        abort(403);
    }

    $pdf = Pdf::loadView('ventas.pedidos.comprobante', [
        'pedido' => $pedido,
        'detalles' => $detalles
    ]);

    return $pdf->download("Comprobante_Pedido_{$id}.pdf");
}


}
