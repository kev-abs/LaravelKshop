<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
USE Carbon\Carbon;


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

         return back()->with('mensaje', 'Cupón agregado correctamente');
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

    // ================= MIS CUPONES =================
    public function misCupones()
    {
        $clienteId = session('id_cliente');
        if (!$clienteId) {
            return redirect()->route('login'); 
        }

        $cupones = DB::table('cupon_cliente as cc')
            ->join('cupon as c', 'c.id_cupon', '=', 'cc.ID_Cupon')
            ->select(
                'cc.ID_Cliente',
                'c.codigo',
                'c.descuento',
                'c.fecha_expiracion',
                'cc.Usado',
                'cc.ID_Cupon as ID_CuponClienteAsignado' // Alias para redimir
            )
            ->where('cc.ID_Cliente', $clienteId)
            ->get();

        return view('Usuario.cliente.cupones.index', compact('cupones'));
    }

    // ================= REDIMIR CUPON =================
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

    // ========================= VALIDAR CUPON (API) =========================
    public function validarCupon($codigo, $idCliente)
    {
        $cupon = DB::table('cupon as c')
            ->join('cupon_cliente as cc', 'c.id_cupon', '=', 'cc.ID_Cupon')
            ->where('c.codigo', $codigo)
            ->where('cc.ID_Cliente', $idCliente)
            ->where('cc.Usado', 0)
            ->where('c.estado', 1)
            ->where('c.fecha_expiracion', '>=', Carbon::today())
            ->select('c.*')
            ->first();

        return $cupon; // null si no existe
    }

    // ========================= USAR CUPON (API) =========================
    public function usarCupon($idCliente, $idCupon)
    {
        DB::table('cupon_cliente')
            ->where('ID_Cliente', $idCliente)
            ->where('ID_Cupon', $idCupon)
            ->update(['Usado' => 1]);
    }

    // ========================= ASIGNAR CUPON (API) =========================
    public function asignarCupon($idCliente, $idCupon)
    {
        DB::table('cupon_cliente')->insert([
            'ID_Cliente' => $idCliente,
            'ID_Cupon'   => $idCupon,
            'Usado'      => 0
        ]);
    }

    // ========================= VISTA ASIGNAR =========================
    public function asignarVista()
    {
        // Traer clientes y cupones válidos
        $clientes = DB::table('cliente')->get(); // ID_Cliente y Nombre están garantizados
        $cupones  = DB::table('cupon')
                    ->where('estado', 1)
                    ->where('fecha_expiracion', '>=', Carbon::today())
                    ->get();

        return view('cupon.asignar', compact('clientes', 'cupones'));
    }
    public function asignar(Request $request)
    {
        $this->asignarCupon($request->ID_Cliente, $request->ID_Cupon);
        return redirect()->back()->with('success', 'Cupón asignado correctamente');
    }
    
    // ================= API: OBTENER CUPONES ACTIVOS =================
    public function apiMisCupones($idCliente)
    {
        $cupones = DB::table('cupon_cliente as cc')
            ->join('cupon as c', 'c.id_cupon', '=', 'cc.ID_Cupon')
            ->select(
                'cc.ID_Cliente',
                'c.codigo',
                'c.descuento',
                'c.fecha_expiracion',
                'cc.Usado',
                'cc.ID_Cupon as ID_CuponClienteAsignado'
            )
            ->where('cc.ID_Cliente', $idCliente)
            ->where('cc.Usado', 0) // Solo cupones habilitados
            ->where('c.fecha_expiracion', '>=', Carbon::today())
            ->get();

        return response()->json($cupones);
    }
}
