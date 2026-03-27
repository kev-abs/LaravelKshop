<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ReportesTest extends TestCase
{
     protected function setUp(): void
    {
        parent::setUp();
        Http::fake(); 
    }
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
        DB::shouldReceive('table')->andReturnSelf();
        DB::shouldReceive('join')->andReturnSelf();
        DB::shouldReceive('select')->andReturnSelf();
        DB::shouldReceive('groupBy')->andReturnSelf();
        DB::shouldReceive('raw')->andReturn(''); // 👈 ESTA ES LA CLAVE
        DB::shouldReceive('get')->andReturn(collect([]));

        $response = $this->withSession(['rol' => 'administrador'])
                        ->get('/admin/reportes/cupones');

        $response->assertStatus(200);
    }
}