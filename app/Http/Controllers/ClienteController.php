<?php


namespace App\Http\Controllers;

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
    
        $productos = Producto::inRandomOrder()->take(3)->get();


        return view('Usuario.panel.panelCliente', compact('productos'));
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
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
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
