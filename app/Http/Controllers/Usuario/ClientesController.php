<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\CodigoRegistroMail;
use App\Exceptions\DocumentoInvalidoException;
use App\Exceptions\TelefonoInvalidoException;
use App\Exceptions\CorreoInvalidoException;
use App\Exceptions\ContrasenaInvalidaException;

class ClientesController
{
    // -------- CLIENTES --------
    public function consultarClientes(Request $request)
    {
        // Filtro
        $orden = $request->get('orden', 'c.Nombre');
        $direccion = $request->get('direccion', 'asc');

        $columnasPermitidas = [
            'c.Nombre',
            'c.Documento',
            'c.ID_Cliente',
            'total_logins'
        ];

        if (!in_array($orden, $columnasPermitidas)) {
            $orden = 'Nombre';
        }

        if (!in_array($direccion, ['asc', 'desc'])) {
            $direccion = 'asc';
        }

        // Conteo de logins
        $clientes = DB::table('cliente as c')
            ->leftJoin('historial_login as h', 'c.ID_Cliente', '=', 'h.ID_Cliente')
            ->select(
                'c.ID_Cliente',
                'c.Nombre',
                'c.Correo',
                'c.Contrasena',
                'c.Foto',
                'c.Documento',
                'c.Telefono',
                'c.Estado',
                'c.Fecha_Registro',
                'c.verificado',
                DB::raw('COUNT(h.ID_Login) as total_logins')
            )
            ->groupBy(
                'c.ID_Cliente',
                'c.Nombre',
                'c.Correo',
                'c.Contrasena',
                'c.Foto',
                'c.Documento',
                'c.Telefono',
                'c.Estado',
                'c.Fecha_Registro',
                'c.verificado'
            )
            ->orderBy($orden, $direccion)
            ->get();

        $totalClientes = DB::table('cliente')->count();

        $clienteMasFrecuente = DB::table('cliente as c')
            ->leftJoin('historial_login as h', 'c.ID_Cliente', '=', 'h.ID_Cliente')
            ->select('c.Nombre', DB::raw('COUNT(h.ID_Login) as total_logins'))
            ->groupBy('c.ID_Cliente', 'c.Nombre')
            ->orderByDesc('total_logins')
            ->first();

        $top5 = DB::table('cliente as c')
            ->leftJoin('historial_login as h', 'c.ID_Cliente', '=', 'h.ID_Cliente')
            ->select('c.Nombre', DB::raw('COUNT(h.ID_Login) as total_logins'))
            ->groupBy('c.ID_Cliente', 'c.Nombre')
            ->orderByDesc('total_logins')
            ->limit(5)
            ->get();

        return view('Usuario.cliente.ClienteConsultarVista', compact(
            'clientes',
            'totalClientes',
            'clienteMasFrecuente',
            'top5'
        ));
    }



    public function mostrarVistaVerificacion()
{
    if (!Session::has('correo_verificacion')) {
        return redirect()->route('login');
    }

    return view('Usuario.cliente.registro.verificar_registro');
}

    public function agregarCliente(Request $request)
    {
        $mensaje = "";

        if ($request->isMethod('post')) {

            $data = $request->only(['nombre', 'correo', 'contrasena', 'documento', 'telefono']);

            // Validar datos
            $validator = Validator::make($data, [
                'nombre' => 'required|string|max:100',
                'correo' => 'required|email|max:100|unique:cliente,Correo',
                'contrasena' => 'required|min:6',
                'documento' => 'required|digits_between:6,15|unique:cliente,Documento',
                'telefono' => 'required|regex:/^[0-9]{10}$/',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();

                if ($errors->has('correo')) {
                    return back()->withInput()->with('error', 'El correo electrónico ingresado no es válido o ya está en uso.');
                }

                if ($errors->has('documento')) {
                    return back()->withInput()->with('error', 'El documento ingresado es inválido o ya existe.');
                }

                if ($errors->has('telefono')) {
                    return back()->withInput()->with('error', 'El número de teléfono no cumple con el formato requerido.');
                }

                if ($errors->has('contrasena')) {
                    return back()->withInput()->with('error', 'La contraseña es demasiado débil o está vacía.');
                }
            } else {
                DB::table('cliente')->insert([
                    'Nombre' => $data['nombre'],
                    'Correo' => $data['correo'],
                    'Contrasena' => bcrypt($data['contrasena']),
                    'Documento' => $data['documento'],
                    'Telefono' => $data['telefono'],
                ]);

                $mensaje = "Cliente agregado correctamente.";
            }
        }

        return view('Usuario.cliente.ClienteAgregarVista', compact('mensaje'));
    }

    public function registrarCliente(Request $request)
    {
        $mensaje = "";

        if ($request->isMethod('post')) {

            $data = $request->only(['nombre', 'correo', 'contrasena', 'documento', 'telefono']);

            $validator = Validator::make($data, [
                'nombre' => 'required|string|max:100',
                'correo' => 'required|email|max:100|unique:cliente,Correo',
                'contrasena' => 'required|min:6',
                'documento' => 'required|digits_between:6,15|unique:cliente,Documento',
                'telefono' => 'required|regex:/^[0-9]{10}$/',
            ]);

            if ($validator->fails()) {

                $errors = $validator->errors();

                if ($errors->has('correo')) {
                    return back()->withInput()->with('error', 'El correo electrónico ingresado no es válido o ya está en uso.');
                }

                if ($errors->has('documento')) {
                    return back()->withInput()->with('error', 'El documento ingresado es inválido o ya existe.');
                }

                if ($errors->has('telefono')) {
                    return back()->withInput()->with('error', 'El número de teléfono no cumple con el formato requerido.');
                }

                if ($errors->has('contrasena')) {
                    return back()->withInput()->with('error', 'La contraseña es demasiado débil o está vacía.');
                }

            } else {

                $codigo = rand(100000, 999999);

                DB::table('cliente')->insert([
                    'Nombre' => $data['nombre'],
                    'Correo' => $data['correo'],
                    'Contrasena' => bcrypt($data['contrasena']),
                    'Documento' => $data['documento'],
                    'Telefono' => $data['telefono'],
                    'codigo_verificacion' => $codigo,
                    'codigo_expira' => now()->addMinutes(2),
                    'verificado' => 0
                ]);

                Mail::to($data['correo'])
                    ->send(new CodigoRegistroMail($codigo, $data['nombre']));

                Session::put('correo_verificacion', $data['correo']);
                return redirect()->route('registro.verificar');
            }
        }

        return view('Usuario.cliente.registro.ClienteRegistrarVista', compact('mensaje'));
    }
    public function confirmarCodigoRegistro(Request $request)
    {
        $correo = Session::get('correo_verificacion');

        if (!$correo) {
            return redirect()->route('login');
        }

        $request->validate([
            'codigo' => 'required'
        ]);

        $cliente = DB::table('cliente')
            ->where('Correo', $correo)
            ->first();

        if (!$cliente) {
            return back()->with('error', 'Cuenta no encontrada.');
        }

        if ($cliente->codigo_verificacion != $request->codigo) {
            return back()->with('error', 'Código incorrecto.');
        }

        if (now()->greaterThan($cliente->codigo_expira)) {
            return back()->with('error', 'El código ha expirado.');
        }

        DB::table('cliente')
            ->where('Correo', $correo)
            ->update([
                'verificado' => 1,
                'codigo_verificacion' => null,
                'codigo_expira' => null
            ]);

        Session::forget('correo_verificacion');

        return redirect()->route('login')
            ->with('mensaje', 'Cuenta verificada correctamente.');
    }
    public function reenviarCodigoRegistro()
    {
        $correo = Session::get('correo_verificacion');

        if (!$correo) {
            return redirect()->route('login');
        }

        $cliente = DB::table('cliente')
            ->where('Correo', $correo)
            ->first();

        if (!$cliente) {
            return back()->with('error', 'Cuenta no encontrada.');
        }

        $codigo = rand(100000, 999999);

        DB::table('cliente')
            ->where('Correo', $correo)
            ->update([
                'codigo_verificacion' => $codigo,
                'codigo_expira' => now()->addMinutes(2)
            ]);

        Mail::to($cliente->Correo)
            ->send(new CodigoRegistroMail($codigo, $cliente->Nombre));

        return back()->with('mensaje', 'Nuevo código enviado.');
    }

    public function mostrarEditarCliente($id)
    {
        $cliente = DB::table('cliente')
            ->where('ID_Cliente', $id)
            ->first();

        if (!$cliente) {
            return redirect()->back()->with('error', 'Cliente no encontrado');
        }

        return view('Usuario.cliente.ClienteActualizarEliminarVista', compact('cliente'));
    }

    public function actualizarCliente(Request $request)
    {
        $id = $request->id_Cliente;

        $data = $request->only(['nombre', 'correo', 'contrasena', 'documento', 'telefono', 'estado']);

        $validator = Validator::make($data, [
            'nombre' => 'required|string|max:100',
            'correo' => "required|email|max:100|unique:cliente,Correo,{$id},ID_Cliente",
            'documento' => "required|digits_between:6,15|unique:cliente,Documento,{$id},ID_Cliente",
            'telefono' => 'required|regex:/^[0-9]{10}$/',
            'contrasena' => 'nullable|min:6',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            if ($errors->has('correo')) throw new CorreoInvalidoException();
            if ($errors->has('documento')) throw new DocumentoInvalidoException();
            if ($errors->has('telefono')) throw new TelefonoInvalidoException();
            if ($errors->has('contrasena')) throw new ContrasenaInvalidaException();
        }

        DB::table('cliente')
            ->where('ID_Cliente', $id)
            ->update([
                'Nombre' => $data['nombre'],
                'Correo' => $data['correo'],
                'Contrasena' => $data['contrasena']
                    ? bcrypt($data['contrasena'])
                    : DB::raw('Contrasena'),
                'Telefono' => $data['telefono'],
                'Documento' => $data['documento'],
                'Estado' => $data['estado']
            ]);

        return redirect()
            ->route('clientes.consultar')
            ->with('mensaje', 'Cliente actualizado correctamente.');
    }


    public function eliminarCliente($id)
    {
        DB::table('cliente')
            ->where('ID_Cliente', $id)
            ->delete();

        return redirect()
            ->route('clientes.consultar')
            ->with('mensaje', 'Cliente eliminado correctamente.');
    }

    public function buscarCliente($id)
    {
        $cliente = DB::table('cliente')
            ->where('ID_Cliente', $id)
            ->first();

        return response()->json($cliente);
    }

    public function historial()
    {
        $clienteId = session('cliente_id'); // o auth()->id() si usas auth

        $pedidos = DB::table('pedido')
            ->where('ID_Cliente', $clienteId)
            ->orderBy('fecha', 'desc')
            ->get();

        return view('panelcliente.historial', compact('pedidos'));
    }
    public function configuracion()
    {
        $id = session('id_cliente');

        $cliente = DB::table('cliente')
            ->where('ID_Cliente', $id)
            ->first();

        return view('Usuario.panel.Confiiguracion.configuracionCliente', compact('cliente'));
    }
    public function cambiarPassword(Request $request)
    {
        if (session('rol') !== 'cliente') {
            return redirect()->route('login');
        }

        $request->validate([
            'actual' => 'required',
            'nueva' => 'required|min:6',
            'confirmar' => 'required'
        ]);

        $id = session('id_cliente');

        $cliente = DB::table('cliente')->where('ID_Cliente', $id)->first();

        if (!Hash::check($request->actual, $cliente->Contrasena)) {
            return back()->with('error', 'Contraseña actual incorrecta');
        }

        if ($request->nueva !== $request->confirmar) {
            return back()->with('error', 'Las contraseñas no coinciden');
        }

        DB::table('cliente')
            ->where('ID_Cliente', $id)
            ->update([
                'Contrasena' => bcrypt($request->nueva)
            ]);

        return back()->with('success', 'Contraseña actualizada correctamente');
    }
}