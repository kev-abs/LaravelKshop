<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\EnvioController;

use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Usuario\UsuariosController;
use App\Http\Controllers\Producto\ProductoController;
use App\Http\Controllers\Usuario\ClienteController;

Route::get('/panel/cliente', [ProductoController::class, 'panelCliente'])
    ->middleware('cliente')
    ->name('cliente.panel');

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
});


Route::get('/envios', [EnvioController::class, 'index'])->name('ventas.envios');

Route::post('/envios', [EnvioController::class, 'store'])->name('envios.store');
Route::put('/envios/{id}', [EnvioController::class, 'update'])->name('envios.update');
Route::delete('/envios/{id}', [EnvioController::class, 'destroy'])->name('envios.destroy');


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