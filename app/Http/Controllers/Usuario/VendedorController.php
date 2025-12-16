<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class VendedorController
{
    /* ================= PANEL VENDEDOR ================= */
    public function panel()
    {
        if (session('rol') !== 'vendedor') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $idEmpleado = session('id_empleado');

        $vendedor = DB::table('Empleado')
            ->where('ID_Empleado', $idEmpleado)
            ->first();

        if (!$vendedor) {
            abort(404, 'Vendedor no encontrado');
        }

        return view('Usuario.panel.panelVendedor', compact('vendedor'));
    }

    /* ================= PERFIL VENDEDOR ================= */
    public function perfilVendedor()
    {
        if (session('rol') !== 'vendedor') {
            return redirect()->route('login');
        }

        $idEmpleado = session('id_empleado');

        $vendedor = DB::table('Empleado')
            ->where('ID_Empleado', $idEmpleado)
            ->first();

        if (!$vendedor) {
            abort(404, 'Vendedor no encontrado');
        }

        return view('Usuario.panel.perfiles.perfilVendedor', compact('vendedor'));
    }

    /* ================= EDITAR PERFIL ================= */
    public function editarPerfilVendedor()
    {
        if (session('rol') !== 'vendedor') {
            return redirect()->route('login');
        }

        $idEmpleado = session('id_empleado');

        $vendedor = DB::table('Empleado')
            ->where('ID_Empleado', $idEmpleado)
            ->first();

        if (!$vendedor) {
            abort(404);
        }

        return view('Usuario.panel.perfiles.editarPerfilVendedor', compact('vendedor'));
    }

    /* ================= ACTUALIZAR PERFIL ================= */
    public function actualizarPerfilVendedor(Request $request)
    {
        if (session('rol') !== 'vendedor') {
            return redirect()->route('login');
        }

        $idEmpleado = session('id_empleado');

        $request->validate([
            'Nombre' => 'required|string|max:100',
            'Correo' => 'required|email',
            'foto'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = [
            'Nombre' => $request->Nombre,
            'Correo' => $request->Correo
        ];

        if ($request->hasFile('foto')) {
            $nombreFoto = 'vendedor_' . $idEmpleado . '.' . $request->foto->extension();
            $request->foto->move(public_path('img/perfiles'), $nombreFoto);

            $data['Foto'] = $nombreFoto;
        }

        DB::table('Empleado')
            ->where('ID_Empleado', $idEmpleado)
            ->update($data);

        return redirect()
            ->route('vendedor.perfil')
            ->with('success', 'Perfil actualizado correctamente');
    }
}
