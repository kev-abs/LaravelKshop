<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use App\Http\Controllers\CheckoutController;
use App\Services\CheckoutService;

class CheckoutControllerTest extends TestCase
{
    use RefreshDatabase;

    private function makeController(?CheckoutService $service = null): CheckoutController
    {
        $service ??= $this->createMock(CheckoutService::class);
        return new CheckoutController($service);
    }

    private function makeRequest(array $data = []): Request
    {
        $request = Request::create('/checkout', 'POST', $data);
        $request->setLaravelSession(session()->driver());
        return $request;
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function redirige_a_login_si_no_hay_sesion_cliente()
    {
        session()->forget('id_cliente');
        session(['carrito' => [1 => ['idProducto' => 1, 'cantidad' => 1]]]);

        $response = $this->makeController()->store($this->makeRequest([
            'direccion'    => 'Calle 123',
            'metodo_pago'  => 'Tarjeta',
            'tipo_entrega' => 'Domicilio',
        ]));

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertStringContainsString('login', $response->getTargetUrl());
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function falla_validacion_si_faltan_campos()
    {
        session(['id_cliente' => 1]);
        session(['carrito'    => [1 => ['idProducto' => 1, 'cantidad' => 1]]]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);

        $this->makeController()->store($this->makeRequest([]));
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function muestra_error_si_falla_el_servicio()
    {
        session(['id_cliente' => 1]);
        session(['carrito'    => [1 => ['idProducto' => 1, 'cantidad' => 1]]]);

        $service = $this->createMock(CheckoutService::class);
        $service->expects($this->once())
            ->method('confirmarCompra')
            ->willReturn(false);

        $response = $this->makeController($service)->store($this->makeRequest([
            'direccion'    => 'Calle 123',
            'metodo_pago'  => 'Tarjeta',
            'tipo_entrega' => 'Domicilio',
        ]));

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals('Error al procesar la compra', session('error'));
    }
}
