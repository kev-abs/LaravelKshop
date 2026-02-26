<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;

class PedidoController
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

        $pedido = Http::get("http://localhost:8080/pedido/$id")->json();

        if (!$pedido || $pedido['idCliente'] != $idCliente) {
            abort(403);
        }

        $detalles = Http::get("http://localhost:8080/pedido/$id/detalle")->json();

        return view('ventas.pedidos.detalle', compact('pedido', 'detalles'));
    }

    public function comprobante($id)
    {
        $idCliente = session('id_cliente');

        $pedido = Http::get("http://localhost:8080/pedido/$id")->json();
        $detalles = Http::get("http://localhost:8080/pedido/$id/detalle")->json();

        $this->validarComprobante($pedido, $idCliente);

        return view('ventas.pedidos.comprobante', compact('pedido','detalles'));
    }

    public function comprobantePdf($id)
    {
        $idCliente = session('id_cliente');

        $pedido = Http::get("http://localhost:8080/pedido/$id")->json();
        $detalles = Http::get("http://localhost:8080/pedido/$id/detalle")->json();

        $this->validarComprobante($pedido, $idCliente);

        $pdf = Pdf::loadView('ventas.pedidos.comprobante', [
            'pedido' => $pedido,
            'detalles' => $detalles
        ]);

        return $pdf->download("Comprobante_Pedido_{$id}.pdf");
    }

    
    private function validarComprobante($pedido, $idCliente)
    {
        // Validar existencia y propiedad del pedido
        if (!$pedido || $pedido['idCliente'] != $idCliente) {
            abort(403);
        }

        // Validar estado de pago
        if (strtoupper($pedido['estadoPago']) !== 'APROBADO') {
            abort(403, 'El comprobante solo está disponible cuando el pago esté aprobado.');
        }
    }
}