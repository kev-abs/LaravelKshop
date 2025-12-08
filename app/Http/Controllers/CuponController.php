<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuponController
{
    public function index()
    {
        return view('cupon.inventarioVista');
    }
    // ================= CONSULTAR CUPONES =================
    public function consultar()
    {
        $cupones = DB::table('cupon')->get();
        return view('cupon.index', compact('cupones'));
    }

   // ================= AGREGAR CUPON =================
    public function store(Request $request)
    {
        $mensaje = "";

        if ($request->isMethod('post')) {

            $data = $request->only(['Codigo', 'Descuento', 'Fecha_Expiracion']);

            if ($data['Codigo'] && $data['Descuento'] && $data['Fecha_Expiracion']) {

                DB::table('cupones')->insert([
                    'codigo' => $data['Codigo'],
                    'descuento' => $data['Descuento'],
                    'fecha_expiracion' => $data['Fecha_Expiracion'],
                ]);

                $mensaje = "Cupón agregado correctamente.";

            } else {
                $mensaje = "Campos obligatorios vacíos.";
            }
        }

        return view('cupon.agregar', compact('mensaje'));
    }
    // ================= ACTUALIZAR / ELIMINAR =================

    public function update(Request $request)
    {
        DB::table('cupones')
            ->where('id_cupon', $request->id_Cupon)
            ->update([
                'codigo' => $request->Codigo,
                'descuento' => $request->Descuento,
                'fecha_expiracion' => $request->Fecha_Expiracion,
            ]);

        return back()->with('mensaje', 'Cupón actualizado correctamente');
    }

    public function destroy(Request $request)
    {
        DB::table('cupones')
            ->where('id_cupon', $request->id_Cupon)
            ->delete();

        return back()->with('mensaje', 'Cupón eliminado correctamente');
    }
}
