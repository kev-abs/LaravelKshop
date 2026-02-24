<?php

namespace App\Http\Controllers\Usuario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsuariosController
{

    public function index() {
        return view('Usuario.usuarioVista');
    }

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
                'c.*',
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
                'c.Fecha_Registro'
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
        DB::table('cliente')
            ->where('ID_Cliente', $request->id_Cliente)
            ->update([
                'Nombre' => $request->nombre,
                'Correo' => $request->correo,
                'Contrasena' => $request->contrasena 
                    ? bcrypt($request->contrasena) 
                    : DB::raw('Contrasena'),
                'Telefono' => $request->telefono,
                'Documento' => $request->documento,
                'Estado' => $request->estado
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
public function panelCliente()
{
    if (session('rol') !== 'cliente') {
        return redirect()->route('login');
    }

    $clienteId = session('id_cliente');

    if (!$clienteId) {
        return redirect()->route('login');
    }

    $cliente = DB::table('cliente')
        ->where('ID_Cliente', $clienteId)
        ->first();

    $totalPedidos = DB::table('pedido')
        ->where('ID_Cliente', $clienteId)
        ->count();

    $totalFavoritos = DB::table('lista_deseos')
        ->where('ID_Cliente', $clienteId)
        ->count();

    $totalCarrito = DB::table('carrito')
        ->where('ID_Cliente', $clienteId)
        ->count();

    $gastoTotal = DB::table('pedido')
        ->where('ID_Cliente', $clienteId)
        ->sum('Total') ?? 0;

    $productos = DB::table('producto')
        ->inRandomOrder()
        ->limit(8)
        ->get();

    return view('Usuario.panel.panelCliente', [
        'cliente' => $cliente,
        'totalPedidos' => $totalPedidos,
        'totalFavoritos' => $totalFavoritos,
        'totalCarrito' => $totalCarrito,
        'gastoTotal' => $gastoTotal,
        'productos' => $productos
    ]);
}
}