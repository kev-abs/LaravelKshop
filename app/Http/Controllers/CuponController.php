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

        
    // ================= VISTA EDITAR / ELIMINAR =================
     public function editarVista()
    {
        return view('cupon.editarEliminar');
    }


   // ================= AGREGAR CUPON =================
    public function store(Request $request)
    {
        $mensaje = "";

        if ($request->isMethod('post')) {

            $data = $request->only(['codigo', 'descuento', 'fecha_expiracion']);

            if ($data['codigo'] && $data['descuento'] && $data['fecha_expiracion']) {

                DB::table('cupon')->insert([
                    'codigo' => $data['codigo'],
                    'descuento' => $data['descuento'],
                    'fecha_expiracion' => $data['fecha_expiracion'],
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
        DB::table('cupon')
            ->where('id_cupon', $request->id_Cupon)
            ->update([
                'codigo' => $request->codigo,
                'descuento' => $request->descuento,
                'fecha_expiracion' => $request->fecha_expiracion,
            ]);

        return back()->with('mensaje', 'Cupón actualizado correctamente');
    }


    public function destroy(Request $request)
    {
        DB::table('cupon')
            ->where('id_cupon', $request->id_Cupon)
            ->delete();

        return back()->with('mensaje', 'Cupón eliminado correctamente');
    }

    // ================= REDIMIR CUPON =================
    public function redimir(Request $request)
    {
        $cuponId = $request->input('ID_CuponCliente');

        DB::table('cupon_cliente')
            ->where('ID_Cupon', $cuponId)
            ->update(['Usado' => true]);

        return redirect()->back()->with('success', '¡Cupón redimido correctamente!');
    }

    public function misCupones()
    {
        // ID del cliente logueado
        $clienteId = session('id_cliente'); // asegúrate de guardar esto en sesión al loguear

        // Obtener los cupones del cliente con su estado
        $cupones = DB::table('cupon_cliente')
            ->join('cupon', 'cupon.id_cupon', '=', 'cupon_cliente.ID_Cupon')
            ->select(
                'cupon_cliente.ID_Cliente',
                'cupon_cliente.ID_Cupon as ID_CuponCliente',
                'cupon.codigo',
                'cupon.descuento',
                'cupon_cliente.Usado'
            )
            ->where('cupon_cliente.ID_Cliente', $clienteId)
            ->get();

        return view('cliente.mis_cupones', compact('cupones'));
    }

}
