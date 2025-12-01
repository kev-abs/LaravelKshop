<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CuponController extends Controller
{
    // ================= CONSULTAR CUPONES =================
    public function index()
    {
        $cupones = DB::table('cupon')->get();
        return view('cupon.index', compact('cupones'));
    }

    // ================= AGREGAR CUPON =================
    public function create()
    {
        return view('cupon.agregar');
    }

    public function store(Request $request)
    {
        DB::table('cupones')->insert([
            'codigo' => $request->Codigo,
            'descuento' => $request->Descuento,
            'fecha_expiracion' => $request->Fecha_Expiracion,
        ]);

        return back()->with('mensaje', 'Cupón agregado correctamente');
    }

    // ================= ACTUALIZAR / ELIMINAR =================
    public function edit()
    {
        return view('cupon.edit');
    }

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
