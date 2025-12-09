<?php

namespace App\Http\Controllers;

use App\Services\PedidoService;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    private $service;

    public function __construct(PedidoService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $Pedidos = $this->service->obtenerPedidos();
        
        $mensaje = $request->query('msg');

        return view('ventas.pedidos', compact('Pedidos', 'mensaje'));
    }

    public function create()
    {
    return view('ventas.pedidos_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_Cliente' => 'required',
            'fecha_Pedido' => 'required',
            'estado' => 'required',
            'total' => 'required',
        
        ]);

        $ok = $this->service->agregarPedidos($request->all());

        return redirect()->route('ventas.pedidos')
            ->with('msg', $ok ? 'Pedido agregado correctamente' : 'Error al agregar');
    }

        public function destroy($id)
    {
        $ok = $this->service->eliminarPedido($id);

        return redirect()->route('ventas.pedidos')
            ->with('msg', $ok ? 'Pedido eliminado correctamente' : 'Error al eliminar');
    }

}
