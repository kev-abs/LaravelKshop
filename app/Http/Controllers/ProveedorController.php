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

    // GUARDAR    
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
        return view('Proveedor.editar');
    }

    // Buscar proveedor por ID
    public function buscar(Request $request)
    {
        $proveedor = DB::table('proveedor')
            ->where('ID_Proveedor', $request->ID_Proveedor)
            ->first();

        if (!$proveedor) {
            return redirect()->back()
                ->with('mensaje', 'Proveedor no encontrado');
        }

        return view('Proveedor.editar', compact('proveedor'));
    }

    // Actualizar proveedor
    public function update(Request $request)
    {
        DB::table('proveedor')
            ->where('ID_Proveedor', $request->ID_Proveedor)
            ->update([
                'Nombre_Empresa' => $request->Nombre_Empresa,
                'Contacto' => $request->Contacto,
                'Telefono' => $request->Telefono,
                'Correo' => $request->Correo,
                'Direccion' => $request->Direccion,
            ]);

        return redirect()->route('proveedor.editar')
    ->with('mensaje', 'Proveedor actualizado correctamente');
    }

    // ELIMINAR
    public function eliminar(Request $request)
    {
        DB::table('proveedor')
            ->where('ID_Proveedor', $request->ID_Proveedor)
            ->delete();

        return redirect()->back()
            ->with('mensaje', 'Proveedor eliminado correctamente');
    }
}