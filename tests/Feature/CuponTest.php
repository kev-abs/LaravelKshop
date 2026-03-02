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
            'fecha_expiracion' => '2026-12-31'
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('cupon', [
            'codigo' => 'DESC50',
            'descuento' => 50,
            'fecha_expiracion' => '2026-12-31'
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
    public function se_puede_actualizar_un_cupon_correctamente()
    {
        // Crear cupón inicial
        $cuponId = DB::table('cupon')->insertGetId([
            'codigo' => 'DESC10',
            'descuento' => 10,
            'fecha_expiracion' => '2026-01-01'
        ]);

        // Actualizar
        $response = $this->put(route('cupon.update'), [
            'id_Cupon' => $cuponId,
            'codigo' => 'DESC20',
            'descuento' => 20,
            'fecha_expiracion' => '2026-12-31'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('cupon', [
            'id_cupon' => $cuponId,
            'codigo' => 'DESC20',
            'descuento' => 20
        ]);
    }

    #[Test]
    public function se_puede_eliminar_un_cupon()
    {
        // Crear cupón
        $cuponId = DB::table('cupon')->insertGetId([
            'codigo' => 'DESC30',
            'descuento' => 30,
            'fecha_expiracion' => '2026-01-01'
        ]);

        // Eliminar
        $response = $this->delete(route('cupon.eliminar'), [
            'id_Cupon' => $cuponId
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('cupon', [
            'id_cupon' => $cuponId
        ]);
    }
}