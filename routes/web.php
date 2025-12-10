<?php

use App\Http\Controllers\CuponController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Usuario\UsuariosController;
use App\Http\Controllers\Producto\ProductoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PedidoController;

Route::get('/cupon', [CuponController::class, 'index'])->name('cupon.inventarioVista');
Route::get('/cupon/consultar', [CuponController::class, 'consultar'])->name('cupon.index');

Route::match(['get', 'post'],'/cupon/guardar', [CuponController::class, 'store'])->name('cupon.guardar');

Route::post('/cupon/editar', [CuponController::class, 'update'])->name('cupon.editar');
Route::post('/cupon/eliminar', [CuponController::class, 'destroy'])->name('cupon.eliminar');


Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::get('/login', [LoginController::class, 'mostrarFormulario'])->name('login');

Route::post('/login', [LoginController::class, 'manejarPeticion'])->name('login.procesar');

Route::view('/panel/admin', 'Usuario.panel.panelAdmin')->name('panel.admin');

Route::get('/panel/cliente', [ProductoController::class, 'panelCliente'])
    ->name('panel.cliente');

Route::view('/panel/vendedor', 'Usuario.panel.panelVendedor')->name('panel.vendedor');

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/catalogo', [ProductoController::class, 'catalogo'])->name('productos.catalogo');


Route::get('/ventas', function () {
    return view('ventas.ventas');
})->name('ventas.ventas');


Route::get('/envios', [EnvioController::class, 'index'])->name('ventas.envios');

Route::post('/envios', [EnvioController::class, 'store'])->name('envios.store');
Route::delete('/envios/{id}', [EnvioController::class, 'destroy'])->name('envios.destroy');
Route::get('/envios/create', [EnvioController::class, 'create'])->name('ventas.envios_create');

Route::get('/pedidos', [PedidoController::class, 'index'])->name('ventas.pedidos');

Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');
Route::post('/pedidos', [PedidoController::class, 'store'])->name('pedidos.store');
Route::get('/pedidos/create', [PedidoController::class, 'create'])->name('ventas.pedidos_create');

Route::get('/productos/agregar', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos/agregar', [ProductoController::class, 'store'])->name('productos.store');

Route::get('/productos/editar/{id}', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/editar/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/eliminar/{id}', [ProductoController::class, 'destroy'])
    ->name('productos.destroy');
Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('inicio');
})->name('logout');

Route::get('/tienda', [ProductoController::class, 'catalogo'])->name('tienda.catalogo');

Route::get('/usuarioVista', [UsuariosController::class,'index'])->name('usuariosVista');

Route::get('/usuarios/clientes',[UsuariosController::class, 'consultarClientes'])->name('clientes.consultar');
Route::match(['get','post'], '/usuarios/clientes/agregar', [UsuariosController::class, 'agregarCliente'])->name('clientes.agregar');
Route::match(['get','post'], '/usuarios/clientes/editar', [UsuariosController::class, 'editarEliminarCliente'])->name('clientes.editar');
Route::get('/usuarios/clientes/buscar/{id}', [UsuariosController::class, 'buscarCliente']);

Route::get('/usuarios/empleados', [UsuariosController::class, 'consultarEmpleados'])->name('empleados.consultar');
Route::match(['get','post'], '/usuarios/empleados/agregar', [UsuariosController::class, 'agregarEmpleado'])->name('empleados.agregar');
Route::match(['get','post'], '/usuarios/empleados/editar', [UsuariosController::class, 'editarEliminarEmpleado'])->name('empleados.editar');
Route::get('/usuarios/empleados/buscar/{id}', [UsuariosController::class, 'buscarEmpleado']);
Route::match(['get','post'],'/usuarios/cliente/registrar',[UsuariosController::class,'registrarCliente'])->name('cliente.registrar');
Route::get('/forgot-password', [AuthController::class, 'mostrarFormularioCodigo'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'enviarCodigo'])->name('password.email');
Route::get('/reset-password', [AuthController::class, 'mostrarFormularioReset'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'actualizarContrasena'])->name('password.update');
