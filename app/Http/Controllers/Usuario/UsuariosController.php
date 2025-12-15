<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Producto\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController
{

    public function index() {
        return view('Usuario.usuarioVista');
    }

    // -------- CLIENTES --------
    public function consultarClientes()
    {
        $clientes = DB::table('cliente')->get();
        return view('Usuario.cliente.ClienteConsultarVista', compact('clientes'));
    }

    public function agregarCliente(Request $request)
    {
        $mensaje = "";

        if ($request->isMethod('post')) {
            $data = $request->only(['nombre', 'correo', 'contrasena', 'documento', 'telefono']);

            if ($data['nombre'] && $data['correo'] && $data['contrasena']) {
                DB::table('cliente')->insert([
                    'Nombre' => $data['nombre'],
                    'Correo' => $data['correo'],
                    'Contrasena' => bcrypt($data['contrasena']),
                    'Documento' => $data['documento'],
                    'Telefono' => $data['telefono'],
                ]);

                $mensaje = "Cliente agregado correctamente.";
            } else {
                $mensaje = "Campos obligatorios vacíos.";
            }
        }

        return view('Usuario.cliente.ClienteAgregarVista', compact('mensaje'));
    }

    public function registrarCliente(Request $request)
    {
        $mensaje = "";

        if ($request->isMethod('post')) {
            $data = $request->only(['nombre', 'correo', 'contrasena', 'documento', 'telefono']);

            if ($data['nombre'] && $data['correo'] && $data['contrasena']) {
                DB::table('cliente')->insert([
                    'Nombre' => $data['nombre'],
                    'Correo' => $data['correo'],
                    'Contrasena' => bcrypt($data['contrasena']),
                    'Documento' => $data['documento'],
                    'Telefono' => $data['telefono'],
                ]);

                $mensaje = "Registro completado exitosamente.";
            } else {
                $mensaje = "Campos obligatorios vacíos.";
            }
        }

        return view('Usuario.cliente.registro.ClienteRegistrarVista', compact('mensaje'));
    }

    public function editarEliminarCliente(Request $request)
    {
        $mensaje = "";

        if ($request->isMethod('post')) {

            $accion = $request->accion;

            if ($accion === "actualizar") {
                DB::table('cliente')
                    ->where('ID_Cliente', $request->id_Cliente)
                    ->update([
                        'Nombre' => $request->nombre,
                        'Correo' => $request->correo,
                        'Contrasena' => $request->contrasena ? bcrypt($request->contrasena) : DB::raw('Contrasena'),
                        'Telefono' => $request->telefono,
                        'Documento' => $request->documento,
                        'Estado' => $request->estado
                    ]);

                $mensaje = "Cliente actualizado correctamente.";
            }

            if ($accion === "eliminar") {
                DB::table('cliente')
                    ->where('ID_Cliente', $request->id_Cliente)
                    ->delete();

                $mensaje = "Cliente eliminado correctamente.";
            }
        }

        return view('Usuario.cliente.ClienteActualizarEliminarVista', compact('mensaje'));
    }

    public function buscarCliente($id)
    {
        $cliente = DB::table('cliente')
            ->where('ID_Cliente', $id)
            ->first();

        return response()->json($cliente);
    }

    // -------- EMPLEADOS --------

    public function consultarEmpleados()
    {
        $empleados = DB::table('Empleado')->get();
        return view('Usuario.Empleado.EmpleadoConsultarVista', compact('empleados'));
    }

    public function agregarEmpleado(Request $request)
    {
        $mensaje = "";

        if ($request->isMethod('post')) {
            $data = $request->only(['nombre', 'cargo', 'correo', 'contrasena', 'estado']);

            if ($data['nombre'] && $data['cargo'] && $data['correo'] && $data['contrasena']) {

                DB::table('Empleado')->insert([
                    'Nombre' => $data['nombre'],
                    'Cargo' => $data['cargo'],
                    'Correo' => $data['correo'],
                    'Contrasena' => bcrypt($data['contrasena']),
                    'Estado' => $data['estado'],
                ]);

                $mensaje = "Empleado agregado correctamente.";
            } else {
                $mensaje = "Campos obligatorios vacíos.";
            }
        }

        return view('Usuario.Empleado.EmpleadoAgregarVista', compact('mensaje'));
    }

    public function editarEliminarEmpleado(Request $request)
    {
        $mensaje = "";

        if ($request->isMethod('post')) {

            if ($request->accion === "actualizar") {

                DB::table('Empleado')
                    ->where('ID_Empleado', $request->id_Empleado)
                    ->update([
                        'Nombre' => $request->nombre,
                        'Cargo' => $request->cargo,
                        'Correo' => $request->correo,
                        'Contrasena' => $request->contrasena ? bcrypt($request->contrasena) : DB::raw('Contrasena'),
                        'Estado' => $request->estado
                    ]);

                $mensaje = "Empleado actualizado correctamente.";
            }

            if ($request->accion === "eliminar") {

                DB::table('Empleado')
                    ->where('ID_Empleado', $request->id_Empleado)
                    ->delete();

                $mensaje = "Empleado eliminado.";
            }
        }

        return view('Usuario.Empleado.EmpleadoActualizarEliminarVista', compact('mensaje'));
    }
    public function buscarEmpleado($id)
    {
        $empleado = DB::table('empleado')->where('ID_Empleado', $id)->first();
        return response()->json($empleado);
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