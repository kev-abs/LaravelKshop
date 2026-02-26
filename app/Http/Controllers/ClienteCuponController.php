<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClienteCuponController
{
    public function index()
{
    $clienteId = session('id_cliente');

    $cupones = DB::table('cupon_cliente')
    ->join('cupon', 'cupon.id_cupon', '=', 'cupon_cliente.ID_Cupon')
    ->select(
        'cupon_cliente.ID_Cliente',
        'cupon_cliente.ID_Cupon',
        'cupon.codigo',
        'cupon.descuento',
        'cupon_cliente.Usado'
    )
    ->where('cupon_cliente.ID_Cliente', $clienteId)
    ->get();

    return view('usuario.cliente.cupones.index', compact('cupones'));
}

}
