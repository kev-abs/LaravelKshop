<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $checkoutService;

    public function __construct(CheckoutService $checkoutService)
    {
        $this->checkoutService = $checkoutService;
    }

    // Mostrar formulario checkout
    public function index()
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('ventas.carrito');
        }

        return view('ventas.checkout', compact('carrito'));
    }

    // Confirmar compra
    public function store(Request $request)
    {
        if (!session()->has('idCliente')) {
        return redirect()->route('login')
            ->with('error', 'Debes iniciar sesión para comprar');
        
        }
        
        $request->validate([
            'direccion'     => 'required|string',
            'metodo_pago'   => 'required|string',
            'tipo_entrega'  => 'required|string',
        ]);

        $carrito = session('carrito', []);
        $idCliente = session('idCliente');

        $data = [
            'idCliente'    => $idCliente,
            'direccion'    => $request->direccion,
            'metodoPago'   => $request->metodo_pago,
            'tipoEntrega' => $request->tipo_entrega,
            'items'        => array_values($carrito)
        ];

        $resultado = $this->checkoutService->confirmarCompra($data);

        if (!$resultado) {
            return back()->with('error', 'Error al procesar la compra');
        }

        session()->forget('carrito');

        return redirect()->route('pedido.exito');
    }
}
