<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PedidoControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware();
        session(['id_cliente' => 1]);
    }

    private function mockApi()
    {
        Http::fake([
            // Historial de pedidos
            '*/pedido/cliente/*' => Http::response([
                [
                    'idPedido'    => 1,
                    'idCliente'   => 1,
                    'fecha'       => '2026-03-27 10:00:00',
                    'total'       => 100000,
                    'estado'      => 'PENDIENTE',
                    'estadoPago'  => 'APROBADO',
                    'estadoEnvio' => 'EN_CAMINO',
                ]
            ], 200),

            // Detalle pedido
            '*/pedido/1/detalle' => Http::response([
                [
                    'idProducto'     => 1,
                    'nombre'         => 'Camiseta',
                    'cantidad'       => 2,
                    'precioUnitario' => 50000,
                    'total'          => 100000,
                ]
            ], 200),

            // Pedido individual (debe ir DESPUÉS del patrón de detalle)
            '*/pedido/1' => Http::response([
                'idPedido'    => 1,
                'idCliente'   => 1,
                'fecha'       => '2026-03-27 10:00:00',
                'total'       => 100000,
                'estado'      => 'PENDIENTE',
                'estadoPago'  => 'APROBADO',
                'estadoEnvio' => 'EN_CAMINO',
                'direccion'   => 'Calle 123',
                'ciudad'      => 'Bogotá',
                'metodoPago'  => 'Tarjeta',
            ], 200),

            // Info producto
            '*/productos/1' => Http::response([
                'imagen' => 'producto.jpg'
            ], 200),
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function puede_ver_historial()
    {
        $this->mockApi();

        $response = $this->get('/mis-pedidos');

        $response->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function puede_ver_detalle_pedido()
    {
        $this->mockApi();

        $response = $this->get('/mis-pedidos/1');

        $response->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function puede_ver_comprobante()
    {
        $this->mockApi();

        $response = $this->get('/pedido/1/comprobante');

        $response->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function puede_descargar_pdf()
    {
        $this->mockApi();

        $response = $this->get('/pedido/1/comprobante/pdf');

        $response->assertStatus(200);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function bloquea_si_no_es_el_cliente()
    {
        session(['id_cliente' => 2]);

        $this->mockApi();

        $response = $this->get('/mis-pedidos/1');

        $response->assertStatus(403);
    }
}
