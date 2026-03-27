<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class EmpleadosController
{

    public function index() {
        return view('Usuario.usuarioVista');
    }

    // -------- EMPLEADOS --------

    public function consultarEmpleados()
    {
        $empleados = DB::table('Empleado')->get();
        return view('Usuario.Empleado.EmpleadoConsultarVista', compact('empleados'));
    }

    public function mostrarEditarEmpleado($id)
    {
        $empleado = DB::table('empleado')
            ->where('ID_Empleado', $id)
            ->first();

        if (!$empleado) {
            return redirect()->back()->with('error', 'Empleado no encontrado');
        }

        return view('Usuario.empleado.EmpleadoActualizarEliminarVista', compact('empleado'));
    }
    public function agregarEmpleado(Request $request)
    {
        if (session('rol') !== 'administrador') {
            return redirect()->back()->with('error', 'No tienes permiso');
        }

        if ($request->isMethod('post')) {

            $data = $request->only(['nombre', 'cargo', 'correo', 'contrasena', 'estado', 'documento', 'telefono']);

            if ($data['nombre'] && $data['cargo'] && $data['correo']&& $data['telefono']&& $data['documento'] && $data['contrasena']) {


                $existeCorreo = DB::table('empleado')
                    ->where('Correo', $data['correo'])
                    ->exists();

                $existeDocumento = DB::table('empleado')
                    ->where('Documento', $data['documento'])
                    ->exists();

                if ($request->contrasena !== $request->confirmar_contrasena) {
                    return back()->with('error', 'Las contraseñas no coinciden');
                }

                if ($existeCorreo) {
                    return back()->with('error', 'El correo ya está registrado');
                }

                if ($existeDocumento) {
                    return back()->with('error', 'El documento ya está registrado');
                }

                $codigo = strval(rand(100000, 999999));

                // Guardar datos temporalmente
                session([
                    'empleado_temp' => $data,
                    'codigo_empleado' => $codigo,
                    'codigo_expira' => now()->addMinutes(5)
                ]);
                // Enviar correo
                Mail::raw("Tu código de verificación es: $codigo", function ($message) use ($data) {
                    $message->to($data['correo'])
                            ->subject('Código de verificación K-SHOP');
                });

                return redirect()->route('empleados.verificarVista');

            } else {
                return back()->with('error', 'Campos obligatorios vacíos');
            }
        }

        return view('Usuario.Empleado.EmpleadoAgregarVista');
    }
    public function verificarEmpleado(Request $request)
    {
        $codigoIngresado = trim($request->codigo);
        $codigoSession = session('codigo_empleado');
        $expira = session('codigo_expira');

        // Validar que exista sesión
        if (!$codigoSession || !session('empleado_temp')) {
            return redirect()->route('empleados.agregar')
                ->with('error', 'Sesión expirada, intenta de nuevo');
        }

        // Validar expiración
        if (now()->gt($expira)) {
            session()->forget(['empleado_temp', 'codigo_empleado', 'codigo_expira']);
            return redirect()->route('empleados.agregar')
                ->with('error', 'El código ha expirado');
        }

        // Comparar códigos
        if ($codigoIngresado === $codigoSession) {

            $data = session('empleado_temp');

            DB::table('empleado')->insert([
                'Nombre' => $data['nombre'],
                'Cargo' => $data['cargo'],
                'Correo' => $data['correo'],
                'Contrasena' => bcrypt($data['contrasena']),
                'Estado' => $data['estado'] ?? 'Activo',
                'Telefono' => $data['telefono'],
                'Documento' => $data['documento'],
            ]);

            session()->forget(['empleado_temp', 'codigo_empleado', 'codigo_expira']);

            return redirect()->route('empleados.consultar')
                ->with('success', 'Empleado creado correctamente');
        }

        return back()->with('error', 'Código incorrecto');
    }
    public function eliminarEmpleado($id)
    {
        DB::table('empleado')
            ->where('ID_Empleado', $id)
            ->delete();

        return redirect()
            ->route('empleados.consultar')
            ->with('mensaje', 'Empleado eliminado correctamente.');
    }

    public function actualizarEmpleado(Request $request)
    {
        if (session('rol') !== 'administrador') {
            return redirect()->back()->with('error', 'No tienes permiso');
        }

        $id = $request->id_Empleado;

        $data = $request->only([
            'nombre',
            'correo',
            'contrasena',
            'cargo',
            'telefono',
            'documento',
            'estado'
        ]);

        $validator = Validator::make($data, [
            'nombre' => 'required|string|max:100',
            'correo' => "required|email|max:100|unique:empleado,Correo,{$id},ID_Empleado",
            'documento' => "required|digits_between:6,15|unique:empleado,Documento,{$id},ID_Empleado",
            'telefono' => 'required|regex:/^[0-9]{10}$/',
            'cargo' => 'required|string|max:50',
            'contrasena' => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        DB::table('empleado')
            ->where('ID_Empleado', $id)
            ->update([
                'Nombre' => $data['nombre'],
                'Correo' => $data['correo'],
                'Cargo' => $data['cargo'],
                'Contrasena' => $data['contrasena']
                    ? bcrypt($data['contrasena'])
                    : DB::raw('Contrasena'),
                'Telefono' => $data['telefono'],
                'Documento' => $data['documento'],
                'Estado' => $data['estado']
            ]);

        return redirect()
            ->route('empleados.consultar')
            ->with('success', 'Empleado actualizado correctamente');
    }

    public function buscarEmpleado($id)
    {
        $empleado = DB::table('empleado')->where('ID_Empleado', $id)->first();
        return response()->json($empleado);
    }
    public function configuracion()
    {
        if (session('rol') !== 'administrador') {
            return redirect()->route('login');
        }

        $admin = DB::table('empleado')
            ->where('ID_Empleado', session('id_empleado'))
            ->first();

        return view('Usuario.panel.Confiiguracion.configuracion', compact('admin'));
    }

    public function cambiarPassword(Request $request)
    {
        $request->validate([
            'actual' => 'required',
            'nueva' => 'required|min:6',
            'confirmar' => 'required|same:nueva'
        ]);

        $id = session('id_empleado');

        $empleado = DB::table('empleado')
            ->where('ID_Empleado', $id)
            ->first();

        if (!$empleado) {
            return back()->with('error', 'Usuario no encontrado');
        }

        if (!Hash::check($request->actual, $empleado->Contrasena)) {
            return back()->with('error', 'La contraseña actual es incorrecta');
        }

        DB::table('empleado')
            ->where('ID_Empleado', $id)
            ->update([
                'Contrasena' => Hash::make($request->nueva)
            ]);

        return back()->with('success', 'Contraseña actualizada correctamente');
    }
}