<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController
{



    public function logout(Request $request)
    {
        Session::flush(); // elimina toda la sesión

        $request->session()->invalidate(); 
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function mostrarFormulario()
    {
        return view('logueo.login');
    }

    public function manejarPeticion(Request $request)
    {
        $correo = $request->input('correo');
        $contrasena = $request->input('contrasena');

        // --- 1. Cliente ---
        $cliente = DB::table('Cliente')
            ->where('Correo', $correo)
            ->first();

        if ($cliente && Hash::check($contrasena, $cliente->Contrasena)) {

            DB::table('historial_login')->insert([
                'ID_Cliente' => $cliente->ID_Cliente,
                'Fecha_Login' => now()
            ]);

            Session::put('id_cliente', $cliente->ID_Cliente);
            Session::put('nombre', $cliente->Nombre);
            Session::put('rol', 'cliente');

            return redirect()->route('panel.cliente');

        }

        // --- 2. Empleado ---
        $empleado = DB::table('Empleado')
            ->where('Correo', $correo)
            ->first();

        if ($empleado) {
            $cargo = strtolower(trim($empleado->Cargo));

            // vendedor 
            if ($cargo === "vendedor") {
                if (Hash::check($contrasena, $empleado->Contrasena)) {

                    Session::put('id_empleado', $empleado->ID_Empleado);
                    Session::put('nombre', $empleado->Nombre);
                    Session::put('rol', 'vendedor');

                    return redirect()->route('panel.vendedor');
                }
            }

        
            if ($cargo === "administrador") {
                if (Hash::check($contrasena, $empleado->Contrasena)) {

                    Session::put('id_empleado', $empleado->ID_Empleado);
                    Session::put('nombre', $empleado->Nombre);
                    Session::put('rol', 'administrador');

                    return redirect()->route('panel.admin');
                }
            }
        }

        // --- Ningún login válido ---
        return back()->with('error', 'Correo o contraseña incorrectos');
    }
}
