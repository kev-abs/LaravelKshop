<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CuponTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
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

    /** @test */
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
}