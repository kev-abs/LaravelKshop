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
        return view('cupon.consultar', compact('cupones'));
    }
        
    // ================= VISTA EDITAR / ELIMINAR =================
     public function editarVista()
    {
        return view('cupon.editarEliminar');
    }


   // ================= AGREGAR CUPON =================
    public function create()
    {
        $mensaje = "";
        return view('cupon.agregar', compact('mensaje'));
    }

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
        $actualizado = DB::table('cupon')
            ->where('id_cupon', $request->id_Cupon)
            ->update([
                'codigo' => $request->codigo,
                'descuento' => $request->descuento,
                'fecha_expiracion' => $request->fecha_expiracion,
            ]);

        if ($actualizado == 0) {
            return back()->with('mensaje', 'El cupón no existe o no se pudo actualizar');
        }

        return back()->with('mensaje', 'Cupón actualizado correctamente');
    }   

    public function destroy(Request $request)
    {
        $eliminado = DB::table('cupon')
            ->where('id_cupon', $request->id_Cupon)
            ->delete();

        if ($eliminado == 0) {
            return back()->with('mensaje', 'El cupón no existe o ya fue eliminado');
        }

        return back()->with('mensaje', 'Cupón eliminado correctamente');
    }
    public function misCupones()
    {
        // --- Valor temporal para demo ---
        $clienteId = 1;
        $clienteId = session('id_cliente');
        dd($clienteId);
        if (!$clienteId) {
            return redirect()->route('login'); 
        }

        
        $cupones = DB::table('cupon_cliente')
            ->leftJoin('cupon', 'cupon.id_cupon', '=', 'cupon_cliente.ID_Cupon')
            ->select(
                'cupon_cliente.ID_Cliente',
                'cupon_cliente.ID_Cupon',
                'cupon.codigo',
                'cupon.descuento',
                'cupon_cliente.Usado'
            )
            ->where('cupon_cliente.ID_Cliente', $clienteId)
            ->get();
        
             // Para verificar que sí estamos obteniendo cupones
            if ($cupones->isEmpty()) {
                dd("No se encontraron cupones para el cliente con ID: $clienteId");
            }
        return view('usuario.cupones.index', compact('cupones'));
    }

    public function redimir(Request $request)
    {
        $clienteId = $request->input('ID_Cliente'); 
        $cuponId   = $request->input('ID_Cupon');  

        if (!$cuponId) {
            return redirect()->back()->with('error', 'Cupón inválido');
        }

        DB::table('cupon_cliente')
            ->where('ID_Cliente', $clienteId)
            ->where('ID_Cupon', $cuponId)
            ->update(['Usado' => true]);

        return redirect()->back()->with('success', '¡Cupón redimido correctamente!');
    }

}
