<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class PedidoTest extends TestCase
{
    #[Test]
    public function no_permite_ver_pedido_de_otro_cliente()
    {
        $this->withSession(['id_cliente' => 1]);

        Http::fake([
            'http://localhost:8080/pedido/10' => Http::response([
                'idCliente' => 2,
                'estadoPago' => 'APROBADO'
            ], 200)
        ]);

        $response = $this->get(route('pedido.detalle', 10));

        $response->assertStatus(403);
    }

    #[Test]
    public function muestra_historial_pedidos()
    {
        $this->withSession(['id_cliente' => 1]);

        Http::fake([
            'http://localhost:8080/pedido/cliente/1' => Http::response([], 200)
        ]);

        $response = $this->get(route('checkout.historial'));

        $response->assertStatus(200);
        $response->assertViewHas('pedidos');
    }

    #[Test]
    public function muestra_detalle_pedido()
    {
        $this->withSession(['id_cliente' => 1]);

        Http::fake([
            'http://localhost:8080/pedido/10' => Http::response([
                'idPedido' => 10,
                'idCliente' => 1,
                'fecha' => '2026-02-26 10:00:00',
                'total' => 150000,
                'estado' => 'ENTREGADO',
                'estadoPago' => 'APROBADO',
                'estadoEnvio' => 'EN CAMINO',
                'metodoPago' => 'TARJETA',
                'direccion' => 'Calle 123',
                'imagen' => 'comprobante.jpg',
                'ciudad' => 'Bogotá',
                'idPago' => 5,
                'idEnvio' => 3
            ], 200),

            'http://localhost:8080/pedido/10/detalle' => Http::response([
                [
                    'nombre' => 'Camisa Nike',
                    'cantidad' => 1,
                    'precioUnitario' => 150000,
                    'total' => 150000
                ]
            ], 200)
        ]);

        $response = $this->get(route('pedido.detalle', 10));

        $response->assertStatus(200);
    }

    #[Test]
    public function no_permite_ver_comprobante_si_no_aprobado()
    {
        $this->withSession(['id_cliente' => 1]);

        Http::fake([
            'http://localhost:8080/pedido/10' => Http::response([
                'idCliente' => 1,
                'estadoPago' => 'PENDIENTE'
            ], 200)
        ]);

        $response = $this->get(route('pedido.comprobante', 10));

        $response->assertStatus(403);
    }

    #[Test]
    public function puede_descargar_comprobante_pdf()
    {
        $this->withSession(['id_cliente' => 1]);

        Http::fake([
            'http://localhost:8080/pedido/10' => Http::response([
                'idPedido' => 10,
                'idCliente' => 1,
                'fecha' => '2026-02-26 10:00:00',
                'total' => 150000,
                'estado' => 'ENTREGADO',
                'estadoPago' => 'APROBADO',
                'estadoEnvio' => 'EN CAMINO',
                'metodoPago' => 'TARJETA',
                'direccion' => 'Calle 123',
                'imagen' => 'comprobante.jpg',
                'ciudad' => 'Bogotá',
                'idPago' => 5,
                'idEnvio' => 3
            ], 200),

            'http://localhost:8080/pedido/10/detalle' => Http::response([
                [
                    'nombre' => 'Camisa Nike',
                    'cantidad' => 1,
                    'precioUnitario' => 150000,
                    'total' => 150000
                ]
            ], 200)
        ]);

        $response = $this->get(route('pedido.comprobante.pdf', 10));

        $response->assertStatus(200);
    }
}
