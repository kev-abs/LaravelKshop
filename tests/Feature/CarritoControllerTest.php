<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class CarritoControllerTest extends TestCase
{
    use RefreshDatabase;

    private function autenticar()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function puede_ver_el_carrito()
    {
        $this->autenticar();

        $response = $this->get('/carrito');


        $response->assertStatus(302);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function puede_agregar_producto_al_carrito()
    {
        $this->autenticar();

        $response = $this->post('/carrito', [
            'idProducto' => 1,
            'cantidad' => 2
        ]);

        $response->assertStatus(302);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function puede_actualizar_cantidad()
    {
        $this->autenticar();

        $response = $this->put('/carrito/cantidad', [
            'idProducto' => 1,
            'cantidad' => 3
        ]);

        $response->assertStatus(302);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function puede_eliminar_producto()
    {
        $this->autenticar();

        $response = $this->delete('/carrito/eliminar', [
            'idProducto' => 1
        ]);

        $response->assertStatus(302);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function puede_confirmar_carrito()
    {
        $this->autenticar();

        $response = $this->get('/carrito/confirmar');


        $response->assertStatus(302);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function puede_hacer_checkout()
    {
        $this->autenticar();

        $response = $this->post('/carrito/checkout', [
            'direccion' => 'Calle 123',
            'ciudad' => 'Bogotá',
            'metodoPago' => 'tarjeta'
        ]);

        $response->assertStatus(302);
    }
}
