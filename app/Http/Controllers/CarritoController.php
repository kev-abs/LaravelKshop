<?php

namespace App\Http\Controllers;

use App\Services\ProductoService;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    protected $productoService;

    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

   
    public function index()
    {
        $carrito = session()->get('carrito', []);
        return view('ventas.carrito', compact('carrito'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'idProducto' => 'required|integer',
            'cantidad'   => 'required|integer|min:1'
        ]);

        
        $resultado = $this->productoService->obtenerProductoPorId(
            $request->idProducto
        );

        if (!$resultado['success']) {
            return back()->with('error', 'Producto no encontrado');
        }

        $producto = $resultado['data'];

        $carrito = session()->get('carrito', []);

        $id = $producto['id_Producto'];

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] += $request->cantidad;
        } else {
            $carrito[$id] = [
                'idProducto' => $id,
                'nombre'     => $producto['nombre'],
                'precio'     => $producto['precio'],
                'imagen'     => $producto['imagen'],
                'cantidad'   => $request->cantidad
            ];
        }

        session()->put('carrito', $carrito);

        return redirect()
            ->route('ventas.carrito')
            ->with('success', 'Producto agregado al carrito');
    }


    public function vaciar()
    {
        session()->forget('carrito');

        return redirect()
            ->route('ventas.carrito')
            ->with('success', 'Carrito vaciado');
    }
}
