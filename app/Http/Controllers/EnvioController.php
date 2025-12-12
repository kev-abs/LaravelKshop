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
            'id_Pedido'      => 'required',
            'direccionEnvio' => 'required',
            'fechaEnvio'     => 'required',
            'metodoEnvio'    => 'required',
            'estadoEnvio'    => 'required',
        ]);

        $ok = $this->service->agregarEnvios($request->all());

        return redirect()->route('ventas.envios')
            ->with('msg', $ok ? 'Envío agregado correctamente' : 'Error al agregar');
    }


    public function edit($id)
    {
        $envio = $this->service->obtenerEnvioPorId($id);

        if (!$envio) {
            return redirect()->route('ventas.envios')->with('msg', 'Envío no encontrado');
        }

        return view('ventas.editar_envio', compact('envio'));
    }


    public function update(Request $request, $id)
    {
        $data = [
            "id_Pedido"      => $request->id_Pedido,
            "direccionEnvio" => $request->direccionEnvio,
            "fechaEnvio"     => $request->fechaEnvio,
            "metodoEnvio"    => $request->metodoEnvio,
            "estadoEnvio"    => $request->estadoEnvio,
        ];

        $ok = $this->service->actualizarEnvio($id, $data);

        if ($ok) {
            return redirect()->route('ventas.envios')->with('msg', 'Envío actualizado correctamente');
        }

        return back()->with('msg', 'No se pudo actualizar el envío');
    }



    public function destroy($id)
    {
        $ok = $this->service->eliminarEnvio($id);

        return redirect()->route('ventas.envios')
            ->with('msg', $ok ? 'Envío eliminado correctamente' : 'Error al eliminar');
    }
}
