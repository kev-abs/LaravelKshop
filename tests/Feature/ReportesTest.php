<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportesTest extends TestCase
{
     use RefreshDatabase; 
    /** @test */
    public function carga_estadisticas_ventas()
    {
        $response = $this->withSession(['rol' => 'administrador'])
                         ->get('/admin/reportes/ventas');

        $response->assertStatus(200);
    }

    /** @test */
    public function carga_productos_mas_vendidos()
    {
        $response = $this->withSession(['rol' => 'administrador'])
                         ->get('/admin/reportes/productos');

        $response->assertStatus(200);
    }

    /** @test */
    public function carga_clientes_frecuentes()
    {
        $response = $this->withSession(['rol' => 'administrador'])
                         ->get('/admin/reportes/clientes');

        $response->assertStatus(200);
    }

    /** @test */
    public function carga_efectividad_cupones()
    {
        $response = $this->withSession(['rol' => 'administrador'])
                         ->get('/admin/reportes/cupones');

        $response->assertStatus(200);
    }
}