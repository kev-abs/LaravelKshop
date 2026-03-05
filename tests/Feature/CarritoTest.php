<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class CarritoTest extends TestCase
{
    #[Test]
    public function muestra_el_carrito_correctamente()
    {
        $this->withSession(['id_cliente' => 1]);

        Http::fake([
            'http://localhost:8080/carrito/1' => Http::response([
                [
                    'idProducto' => 10,
                    'nombre' => 'Zapatos',
                    'precio' => 100000,
                    'cantidad' => 2,
                    'subtotal' => 200000
                ]
            ], 200)
        ]);

        $response = $this->get(route('ventas.carrito.index'));

        $response->assertStatus(200);
        $response->assertViewHas('carrito');
    }
    #[Test]
    public function puede_agregar_producto_al_carrito()
    {
        $this->withSession(['id_cliente' => 1]);

        Http::fake();

        $response = $this->post(route('carrito.store'), [
            'idProducto' => 5,
            'cantidad' => 3
        ]);

        $response->assertRedirect(route('ventas.carrito.index'));

        Http::assertSent(function ($request) {
            return $request->url() == "http://localhost:8080/carrito"
                && $request['idProducto'] == 5
                && $request['cantidad'] == 3;
        });
    }
    #[Test]
    public function puede_actualizar_cantidad()
    {
        $this->withSession(['id_cliente' => 1]);

        Http::fake();

        $response = $this->put(route('carrito.update'), [
            'idProducto' => 10,
            'cantidad' => 5
        ]);

        $response->assertRedirect(route('ventas.carrito.index'));

        Http::assertSent(function ($request) {
            return $request->url() == "http://localhost:8080/carrito/cantidad"
                && $request['cantidad'] == 5;
        });
    }
    #[Test]
    public function puede_eliminar_producto()
    {
        $this->withSession(['id_cliente' => 1]);

        Http::fake();

        $response = $this->delete(route('carrito.delete'), [
            'idProducto' => 10
        ]);

        $response->assertRedirect(route('ventas.carrito.index'));

        Http::assertSent(function ($request) {
            return $request->method() === 'DELETE'
                && $request->url() == "http://localhost:8080/carrito/producto";
        });
    }
    #[Test]
    public function puede_hacer_checkout()
    {
        $this->withSession(['id_cliente' => 1]);

        Http::fake();

        $response = $this->post(route('carrito.checkout'), [
            'direccion' => 'Calle 123',
            'ciudad' => 'Bogotá',
            'metodoPago' => 'TARJETA'
        ]);

        $response->assertRedirect(route('checkout.historial'));

        Http::assertSent(function ($request) {
            return $request->url() == "http://localhost:8080/carrito/checkout";
        });
    }
    #[Test]
    public function muestra_vista_confirmacion()
    {
        $this->withSession(['id_cliente' => 1]);

        Http::fake([
            'http://localhost:8080/carrito/1' => Http::response([
                'items' => [
                    [
                        'idProducto' => 10,
                        'nombre' => 'Zapatos',
                        'cantidad' => 2,
                        'total' => 200000,
                        'imagen' => null
                    ]
                ],
                'subtotal' => 200000
            ], 200)
        ]);

        $response = $this->get(route('carrito.confirmar'));

        $response->assertStatus(200);
    }
}
