<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\producto\Producto;
use Illuminate\Http\Request;

class ClienteController
{
    public function panel()
{
    if (session('rol') !== 'cliente') {
        return redirect()->route('login');
    }

    $idCliente = session('id_cliente');

    $productos = Producto::inRandomOrder()->take(4)->get();

    $productos2 = Producto::inRandomOrder()->take(8)->get();

    $totalPedidos = DB::table('pedido')
        ->where('ID_Cliente', $idCliente)
        ->count('ID_Pedido');

    $totalFavoritos = DB::table('lista_deseos')
        ->where('ID_Cliente', $idCliente)
        ->count();
    
    
    $totalCarrito = DB::table('detalle_carrito')
        ->join('carrito', 'detalle_carrito.ID_Carrito', '=', 'carrito.ID_Carrito')
        ->where('carrito.ID_Cliente', $idCliente)
        ->sum('detalle_carrito.cantidad');

    $gastoTotal = DB::table('pedido')
        ->where('ID_Cliente', $idCliente)
        ->sum('Total') ?? 0;

    return view('Usuario.panel.panelCliente', compact(
        'productos',
        'productos2',
        'totalPedidos',
        'totalFavoritos',
        'totalCarrito',
        'gastoTotal'
    ));
}
    public function perfil()
    {
        if (session('rol') !== 'cliente') {
            return redirect()->route('login');
        }

        $idCliente = session('id_cliente');

        $cliente = DB::table('cliente')
            ->where('ID_Cliente', $idCliente)
            ->first();

        if (!$cliente) {
            abort(404, 'Cliente no encontrado');
        }

        return view('Usuario.panel.perfiles.perfilCliente', compact('cliente'));
    }

    public function editarPerfil()
    {
        if (session('rol') !== 'cliente') {
            return redirect()->route('login');
        }

        $idCliente = session('id_cliente');

        $cliente = DB::table('cliente')
            ->where('ID_Cliente', $idCliente)
            ->first();

        if (!$cliente) {
            abort(404);
        }

        return view('Usuario.panel.perfiles.editarPerfilCliente', compact('cliente'));
    }

    public function actualizarPerfil(Request $request)
    {
        if (session('rol') !== 'cliente') {
            return redirect()->route('login');
        }

        $idCliente = session('id_cliente');

        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Correo' => 'required|email',
            'Documento' => 'nullable|string|max:20',
            'Telefono' => 'nullable|string|max:20',
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png|max:5000'
        ]);


        $data = [
            'Nombre' => $request->Nombre,
            'Correo' => $request->Correo,
            'Documento' => $request->Documento,
            'Telefono' => $request->Telefono,
        ];


        if ($request->hasFile('foto')) {
            $nombreFoto = 'cliente_' . $idCliente . '.' . $request->foto->extension();
            $request->foto->move(public_path('img/perfilCliente'), $nombreFoto);

            $data['Foto'] = $nombreFoto;
        }

        DB::table('cliente')
            ->where('ID_Cliente', $idCliente)
            ->update($data);

        return redirect()
            ->route('cliente.perfil')
            ->with('success', 'Perfil actualizado correctamente');
    }
}
