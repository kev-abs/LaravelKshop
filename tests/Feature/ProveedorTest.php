<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\DB;

class ProveedorTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function se_puede_crear_un_proveedor_correctamente()
    {
        $response = $this->post(route('proveedor.guardar'), [
            'Nombre_Empresa' => 'Nike',
            'Contacto' => 'Juan Perez',
            'Telefono' => '123456789',
            'Correo' => 'nike@test.com',
            'Direccion' => 'Calle 123'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('proveedor', [
            'Nombre_Empresa' => 'Nike',
            'Correo' => 'nike@test.com'
        ]);
    }

    #[Test]
    public function se_puede_actualizar_un_proveedor_correctamente()
    {
        // Crear proveedor inicial
        $proveedorId = DB::table('proveedor')->insertGetId([
            'Nombre_Empresa' => 'Adidas',
            'Contacto' => 'Carlos',
            'Telefono' => '987654321',
            'Correo' => 'adidas@test.com',
            'Direccion' => 'Calle 456'
        ]);

        // Actualizar proveedor
        $response = $this->put(route('proveedor.update'), [
            'ID_Proveedor' => $proveedorId,
            'Nombre_Empresa' => 'Adidas Updated',
            'Contacto' => 'Carlos M',
            'Telefono' => '111222333',
            'Correo' => 'adidas_updated@test.com',
            'Direccion' => 'Calle Nueva 789'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('proveedor', [
            'ID_Proveedor' => $proveedorId,
            'Nombre_Empresa' => 'Adidas Updated',
            'Correo' => 'adidas_updated@test.com'
        ]);
    }

    #[Test]
    public function se_puede_eliminar_un_proveedor()
    {
        // Crear proveedor
        $proveedorId = DB::table('proveedor')->insertGetId([
            'Nombre_Empresa' => 'Puma',
            'Contacto' => 'Luis',
            'Telefono' => '555666777',
            'Correo' => 'puma@test.com',
            'Direccion' => 'Calle 999'
        ]);

        // Eliminar proveedor
        $response = $this->delete(route('proveedor.eliminar'), [
            'ID_Proveedor' => $proveedorId
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('proveedor', [
            'ID_Proveedor' => $proveedorId
        ]);
    }
}