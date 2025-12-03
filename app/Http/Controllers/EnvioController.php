<?php

namespace App\Http\Controllers;

use App\Services\EnvioService;
use Illuminate\Http\Request;

class EnvioController extends Controller
{
    private $service;

    public function __construct(EnvioService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $Envios = $this->service->obtenerEnvios();
        
        $mensaje = $request->query('msg');

        return view('ventas.envios', compact('Envios', 'mensaje'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_Pedido' => 'required',
            'direccionEnvio' => 'required',
            'fechaEnvio' => 'required',
            'metodoEnvio' => 'required',
            'estadoEnvio' => 'required',
        ]);

        $ok = $this->service->agregarEnvios($request->all());

        return redirect()->route('ventas.envios')
            ->with('msg', $ok ? 'Envío agregado correctamente' : 'Error al agregar');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_Pedido' => 'required',
            'direccionEnvio' => 'required',
            'fechaEnvio' => 'required',
            'metodoEnvio' => 'required',
            'estadoEnvio' => 'required',
        ]);

        $ok = $this->service->actualizarEnvios($id, $request->all());

        return redirect()->route('ventas.envios')
            ->with('msg', $ok ? 'Envío actualizado correctamente' : 'Error al actualizar');
    }

    public function destroy($id)
    {
        $ok = $this->service->eliminarEnvio($id);

        return redirect()->route('ventas.envios')
            ->with('msg', $ok ? 'Envío eliminado correctamente' : 'Error al eliminar');
    }
}
