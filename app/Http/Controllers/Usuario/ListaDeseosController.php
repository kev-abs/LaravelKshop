<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListaDeseosController
{
    public function productos()
    {
        if (session('rol') !== 'cliente') {
            return redirect()->route('login');
        }

        $productos = DB::table('producto')->get();

        return view('Usuario.ListaDeseos.productos', compact('productos'));
    }
    public function index()
    {
        if (session('rol') !== 'cliente') {
            return redirect()->route('login');
        }

        $idCliente = session('id_cliente');

        $deseos = DB::table('lista_deseos as ld')
            ->join('producto as p', 'ld.ID_Producto', '=', 'p.ID_Producto')
            ->where('ld.ID_Cliente', $idCliente)
            ->select('ld.ID_Lista', 'p.Nombre', 'p.Precio', 'p.Imagen')
            ->get();

        return view('Usuario.listaDeseos.listaDeseos', ['deseos' => $deseos]);
    }

    public function agregar(Request $request)
    {
        if (session('rol') !== 'cliente') {
            return redirect()->route('login');
        }

        $idCliente = session('id_cliente');
        $idProducto = $request->ID_Producto;

        $existe = DB::table('lista_deseos')
            ->where('ID_Cliente', $idCliente)
            ->where('ID_Producto', $idProducto)
            ->first();

        if (!$existe) {
            DB::table('lista_deseos')->insert([
                'ID_Cliente' => $idCliente,
                'ID_Producto' => $idProducto,
                'Fecha_Creacion' => now()
            ]);
        }

        return redirect()->back()->with('success', 'Producto agregado a la lista de deseos');
    }

    public function eliminar($idLista)
    {
        if (session('rol') !== 'cliente') {
            return redirect()->route('login');
        }

        DB::table('lista_deseos')->where('ID_Lista', $idLista)->delete();

        return redirect()->back()->with('success', 'Producto eliminado de la lista de deseos');
    }
}
