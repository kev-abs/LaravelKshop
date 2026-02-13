<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    private $apiUrl = "http://localhost:8080/proveedores";

    // LISTAR
    public function index()
    {
        $proveedores = DB::table('proveedor')->get();

        return view('Proveedor.consultar', compact('proveedores'));
    }

    // FORM AGREGAR
    public function create()
    {
        return view('Proveedor.agregar');
    }

    public function guardar(Request $request)
    {
        DB::table('proveedor')->insert([
            'Nombre_Empresa' => $request->Nombre_Empresa,
            'Contacto' => $request->Contacto,
            'Telefono' => $request->Telefono,
            'Correo' => $request->Correo,
            'Direccion' => $request->Direccion,
        ]);

        return redirect()->route('proveedor.agregar')
           ->with('success', 'Proveedor agregado correctamente');
    }

    // VISTA EDITAR
    public function editView()
    {
        $response = Http::get($this->apiUrl);
        $proveedores = $response->json();

        return view('Proveedor.editar', compact('proveedores'));
    }

    // ACTUALIZAR
    public function update(Request $request, $id)
    {
        Http::put($this->apiUrl . '/' . $id, [
            "nombre_Empresa" => $request->nombre_Empresa,
            "contacto"       => $request->contacto,
            "telefono"       => $request->telefono,
            "correo"         => $request->correo,
            "direccion"      => $request->direccion,
        ]);

        return redirect()->route('proveedor.editar')
                         ->with('success', 'Proveedor actualizado');
    }

    // ELIMINAR
    public function destroy($id)
    {
        Http::delete($this->apiUrl . '/' . $id);

        return redirect()->route('proveedor.editar')
                         ->with('success', 'Proveedor eliminado');
    }
}