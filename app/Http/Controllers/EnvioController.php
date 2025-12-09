<?php

namespace App\Http\Controllers;

use App\Services\EnvioService;
use Illuminate\Http\Request;

class EnvioController 
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

    public function create()
    {
    return view('ventas.envios_create');
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


    public function destroy($id)
    {
        $ok = $this->service->eliminarEnvio($id);

        return redirect()->route('ventas.envios')
            ->with('msg', $ok ? 'Envío eliminado correctamente' : 'Error al eliminar');
    }
}
