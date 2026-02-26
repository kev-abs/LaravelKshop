<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\CodigoRecuperacionMail;

class AuthController
{
    public function mostrarFormularioCodigo()
    {
        return view('logueo.OlvidasteVista');
    }

    public function enviarCodigo(Request $request)
    {
        $request->validate([
            'correo' => 'required|email'
        ]);

        $correo = $request->correo;

        $cliente = DB::table('cliente')->where('Correo', $correo)->first();

        if (!$cliente) {
            return back()->with('mensaje', 'El correo no está registrado.');
        }

        $codigo = rand(100000, 999999);

        // Guardar código temporal
        DB::table('password_resets')->updateOrInsert(
            ['email' => $correo],
            [
                'token' => $codigo,
                'created_at' => now()
            ]
        );

        $nombre = $cliente->Nombre;

        Mail::to($correo)->send(new CodigoRecuperacionMail($codigo, $correo, $nombre));

        return redirect()->route('password.reset')->with('correo', $correo);
    }

    public function mostrarFormularioReset(Request $request)
    {
        $correo = session('correo');
        return view('logueo.ResetContraseña', compact('correo'));
    }

    public function actualizarContrasena(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'codigo' => 'required',
            'contrasena' => 'required|min:6'
        ]);

        $correo = $request->correo;

        $reset = DB::table('password_resets')->where('email', $correo)->first();

        if (!$reset || $reset->token != $request->codigo) {
            return back()->with('mensaje', 'Código incorrecto.');
        }

        DB::table('cliente')
            ->where('Correo', $correo)
            ->update([
                'Contrasena' => Hash::make($request->contrasena)
            ]);

        DB::table('password_resets')->where('email', $correo)->delete();

        return redirect()->route('login')->with('mensaje', 'Contraseña actualizada correctamente.');
    }
}
