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
<<<<<<< HEAD

    $genero      = $request->query('genero');
    $categoriaId = $request->query('categoria');

    $query = DB::table('producto as p');

    if (!empty($genero)) {
        $query->where('p.Genero', $genero);
    }

    if (!empty($categoriaId)) {
        $query->join('producto_categoria as pc', 'p.ID_Producto', '=', 'pc.ID_Producto')
              ->where('pc.ID_Categoria', $categoriaId);
    }

    $productos = $query->select('p.*')->get();

    // Categorías directo de la BD
  $categorias = DB::select('SELECT ID_Categoria as idCategoria, Nombre as nombre FROM categoria');

    $idCliente = session('id_cliente');
    $favoritos = DB::table('lista_deseos')
                   ->where('ID_Cliente', $idCliente)
                   ->pluck('ID_Producto')
                   ->toArray();

  return view('Usuario.ListaDeseos.productos', compact(
    'productos',
    'genero',
    'favoritos',
    'categorias',
    'categoriaId'

    ));
}
public function listar(Request $request)
{
    $response = Http::get('http://35.175.5.116:8080/productos/filtrar', [
        'nombre'      => $request->query('nombre'),
        'idCategoria' => $request->query('idCategoria')
    ]);

    $productos = collect($response->json())->map(function($p) {
        return (object) [
            'ID_Producto' => $p['id_Producto'] ?? null,
            'Nombre'      => $p['nombre']      ?? null,
            'Descripcion' => $p['descripcion'] ?? null,
            'Precio'      => $p['precio']      ?? null,
            'Stock'       => $p['stock']       ?? null,
            'Imagen'      => $p['imagen']      ?? null,
            'Estado'      => $p['estado']      ?? null,
            'Genero'      => $p['genero']      ?? null,
        ];
    });

    $categorias  = DB::select('SELECT ID_Categoria as idCategoria, Nombre as nombre FROM categoria');
    $categoriaId = $request->query('categoria');
    $genero      = $request->query('genero');

    $idCliente = session('id_cliente');
    $favoritos = DB::table('lista_deseos')
                   ->where('ID_Cliente', $idCliente)
                   ->pluck('ID_Producto')
                   ->toArray();

    return view('Usuario.ListaDeseos.productos',
        compact('productos', 'categorias', 'categoriaId', 'genero', 'favoritos')
    );
}
=======
>>>>>>> parent of 4cb488b (categorizacion cliente)
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
