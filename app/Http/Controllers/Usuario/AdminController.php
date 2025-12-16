<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController
{
    public function panel()
    {
        if (session('rol') !== 'administrador') {
            return redirect()->route('login')->with('error', 'Acceso no autorizado');
        }

        $idEmpleado = session('id_empleado');

        $admin = DB::table('Empleado')
            ->where('ID_Empleado', $idEmpleado)
            ->first();

        return view('Usuario.panel.panelAdmin', compact('admin'));
    }
    public function perfilAdmin()
    {
        if (session('rol') !== 'administrador') {
            return redirect()->route('login');
        }

        $idEmpleado = session('id_empleado');

        $admin = DB::table('empleado')
            ->where('ID_Empleado', $idEmpleado)
            ->first();

        if (!$admin) {
            abort(404, 'Administrador no encontrado');
        }

        return view('Usuario.panel.perfiles.perfilAdmin', compact('admin'));
    }
    public function editarPerfilAdmin()
    {
        if (session('rol') !== 'administrador') {
            return redirect()->route('login');
        }

        $idEmpleado = session('id_empleado');

        $admin = DB::table('empleado')
            ->where('ID_Empleado', $idEmpleado)
            ->first();

        if (!$admin) {
            abort(404);
        }

        return view('Usuario.panel.perfiles.editarPerfilAdmin', compact('admin'));
    }


    public function actualizarPerfilAdmin(Request $request)
    {
        if (session('rol') !== 'administrador') {
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
            $nombreFoto = 'admin_' . $idEmpleado . '.' . $request->foto->extension();
            $request->foto->move(public_path('img/perfiles'), $nombreFoto);

            $data['Foto'] = $nombreFoto;
        }

        DB::table('empleado')
            ->where('ID_Empleado', $idEmpleado)
            ->update($data);

        return redirect()
            ->route('admin.perfil')
            ->with('success', 'Perfil actualizado correctamente');
    }
}
