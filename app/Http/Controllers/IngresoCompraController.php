<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IngresoCompraController
{
    public function index() {
        $ingresos = DB::table('ingreso_compra')->get();
        return view('ingresocompra.index', compact('ingresos'));
    }

    public function create() {
        return view('ingresocompra.create');
    }

    public function store(Request $request) {
        DB::table('ingreso_compra')->insert($request->only(
            'ID_Empleado','ID_Proveedor','Fecha_Ingreso','Total'
        ));

        return back()->with('mensaje','Ingreso registrado correctamente');
    }

  public function update(Request $request)
    {
        $actualizado = DB::table('ingreso_compra')
            ->where('ID_Ingreso', $request->ID_Ingreso)
            ->update([
                'ID_Empleado' => $request->ID_Empleado,
                'ID_Proveedor' => $request->ID_Proveedor,
                'Fecha_Ingreso' => $request->Fecha_Ingreso,
                'Total' => $request->Total
            ]);

        if ($actualizado == 0) {
            return back()->with('mensaje', 'El ingreso no existe o no se pudo actualizar');
        }

        return back()->with('mensaje', 'Ingreso actualizado correctamente');
    }

    public function destroy(Request $request)
        {
            $eliminado = DB::table('ingreso_compra')
                ->where('ID_Ingreso', $request->ID_Ingreso)
                ->delete();

            if ($eliminado == 0) {
                return back()->with('mensaje', 'El ingreso no existe o ya fue eliminado');
            }

            return back()->with('mensaje', 'Ingreso eliminado correctamente');
        }
    
    public function editDeleteVista()
        {
            return view('ingresocompra.editDelete');
        }

}
