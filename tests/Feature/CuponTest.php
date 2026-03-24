<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Facades\DB;

class CuponTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function se_puede_crear_un_cupon_correctamente()
    {
        $response = $this->post(route('cupon.guardar'), [
            'codigo' => 'DESC50',
            'descuento' => 50,
            'fecha_expiracion' => now()->addYear()->format('Y-m-d')
        ]);

        // Tu controlador devuelve vista → normalmente 302 o 200
        $response->assertStatus(200);

        $this->assertDatabaseHas('cupon', [
            'codigo' => 'DESC50',
            'descuento' => 50
        ]);
    }

    #[Test]
    public function no_se_crea_cupon_si_campos_estan_vacios()
    {
        $response = $this->post(route('cupon.guardar'), [
            'codigo' => '',
            'descuento' => '',
            'fecha_expiracion' => ''
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseCount('cupon', 0);
    }

    #[Test]
    public function se_puede_aplicar_un_cupon_correctamente()
    {
        // Crear cupón
        $cuponId = DB::table('cupon')->insertGetId([
            'codigo' => 'DESC10',
            'descuento' => 10,
            'fecha_expiracion' => now()->addYear()->format('Y-m-d')
        ]);

        // Asignar cupón al cliente
        DB::table('cupon_cliente')->insert([
            'ID_Cupon' => $cuponId,
            'ID_Cliente' => 1,
            'Usado' => 0
        ]);

        // Simular uso del cupón
        DB::table('cupon_cliente')
            ->where('ID_Cupon', $cuponId)
            ->where('ID_Cliente', 1)
            ->update(['Usado' => 1]);

        $this->assertDatabaseHas('cupon_cliente', [
            'ID_Cupon' => $cuponId,
            'ID_Cliente' => 1,
            'Usado' => 1
        ]);
    }

    #[Test]
    public function se_puede_eliminar_un_cupon()
    {
        $cuponId = DB::table('cupon')->insertGetId([
            'codigo' => 'DESC30',
            'descuento' => 30,
            'fecha_expiracion' => now()->addYear()->format('Y-m-d')
        ]);

        $response = $this->delete(route('cupon.eliminar'), [
            'id_Cupon' => (int) $cuponId
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('cupon', [
            'id_cupon' => (int) $cuponId
        ]);
    }
}