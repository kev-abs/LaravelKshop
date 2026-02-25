<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProveedorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function se_puede_crear_un_proveedor_correctamente()
    {
        $response = $this->post(route('proveedor.guardar'), [
            'Nombre_Empresa' => 'Nike',
            'Contacto' => 'Juan Perez',
            'Telefono' => '123456789',
            'Correo' => 'nike@test.com',
            'Direccion' => 'Calle 123'
        ]);

        // Laravel normalmente redirige después de guardar
        $response->assertStatus(302);

        $this->assertDatabaseHas('proveedor', [
            'Nombre_Empresa' => 'Nike',
            'Correo' => 'nike@test.com'
        ]);
    }
}