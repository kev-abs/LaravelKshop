<?php

use App\Http\Controllers\AdminPedidoController;
use App\Http\Controllers\CuponController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\IngresoCompraController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Usuario\UsuariosController;
use App\Http\Controllers\Producto\ProductoController;
use App\Http\Controllers\Producto\ProductoCategoriaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\Usuario\AdminController;
use App\Http\Controllers\Usuario\VendedorController;
use App\Http\Controllers\Usuario\ListaDeseosController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ClienteCuponController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CheckoutController;


Route::get('/cupon', [CuponController::class, 'index'])->name('cupon.inventarioVista');

Route::get('/cupon/consultar', [CuponController::class, 'consultar'])->name('cupon.index');

Route::match(['get', 'post'],'/cupon/guardar', [CuponController::class, 'store'])->name('cupon.guardar');

Route::get('/cupon/editar', [CuponController::class, 'editarVista'])->name('cupon.editarVista');

Route::put('/cupon/editar', [CuponController::class, 'update'])->name('cupon.update');

Route::delete('/cupon/eliminar', [CuponController::class, 'destroy'])->name('cupon.eliminar');

//INGRESO_COMPRA
Route::get('/ingresocompra', [IngresoCompraController::class, 'index'])
    ->name('ingresocompra.index');

Route::get('/ingresocompra/crear', [IngresoCompraController::class, 'create'])
    ->name('ingresocompra.create');

Route::post('/ingresocompra/guardar', [IngresoCompraController::class, 'store'])
    ->name('ingresocompra.store');

Route::get('/ingresocompra/{id}/editar', [IngresoCompraController::class, 'edit'])
    ->name('ingresocompra.edit');

Route::put('/ingresocompra/actualizar', [IngresoCompraController::class, 'update'])
    ->name('ingresocompra.update');

Route::delete('/ingresocompra/eliminar', [IngresoCompraController::class, 'destroy'])
    ->name('ingresocompra.destroy');

Route::get('/ingresocompra/editar', [IngresoCompraController::class, 'editDeleteVista'])
    ->name('ingresocompra.editDelete');

Route::put('/cupon/editar', [CuponController::class, 'update'])->name('cupon.update');
Route::delete('/cupon/eliminar', [CuponController::class, 'destroy'])->name('cupon.eliminar');

Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::get('/login', [LoginController::class, 'mostrarFormulario'])->name('login');

Route::post('/login', [LoginController::class, 'manejarPeticion'])->name('login.procesar');
Route::get('/panel/admin', [AdminController::class, 'panel'])->name('panel.admin');
Route::get('usuarios/panel/perfiles/perfilAdmin', [AdminController::class, 'perfilAdmin'])->name('admin.perfil');
Route::get('usuarios/panel/perfiles/editarPerfilAdmin',[AdminController::class, 'editarPerfilAdmin'])->name('admin.perfil.editar');
Route::post('usuarios/panel/perfiles/actualizarPerfilAdmin',[AdminController::class, 'actualizarPerfilAdmin'])->name('admin.perfil.actualizar');
Route::get('/panel/vendedor', [VendedorController::class, 'panel'])->name('panel.vendedor');
Route::get('/panel/vendedor/perfil', [VendedorController::class, 'perfil'])->name('vendedor.perfil');
Route::get('/panel/vendedor', [VendedorController::class, 'panel'])->name('panel.vendedor');
Route::get('/panel/vendedor/perfil', [VendedorController::class, 'perfilVendedor'])->name('vendedor.perfil');
Route::get('/panel/vendedor/perfil/editar', [VendedorController::class, 'editarPerfilVendedor'])->name('vendedor.perfil.editar');
Route::post('/panel/vendedor/perfil/actualizar', [VendedorController::class, 'actualizarPerfilVendedor'])->name('vendedor.perfil.actualizar');
Route::get('/cliente/panel', [ClienteController::class, 'panel'])->name('panel.cliente');
Route::get('/cliente/perfil', [ClienteController::class, 'perfil'])->name('cliente.perfil');
Route::get('/panel/cliente/perfil/editar', [ClienteController::class, 'editarPerfil'])->name('cliente.perfil.editar');
Route::post('/panel/cliente/perfil/actualizar', [ClienteController::class, 'actualizarPerfil'])->name('cliente.perfil.actualizar');


Route::get('/ventas', function () {
    return view('ventas.ventas');
})->name('ventas.ventas');


Route::get('/productos/agregar', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos/agregar', [ProductoController::class, 'store'])->name('productos.store');

Route::get('/productos/editar/{id}', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/editar/{id}', [ProductoController::class, 'update'])->name('productos.update');
Route::delete('/productos/eliminar/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/catalogo', [ProductoController::class, 'catalogo'])->name('productos.catalogo');
Route::get('/productos/catalogovista', [ProductoController::class, 'vistacatalogo'])->name('productos.vistaCatalogo');
Route::get('/productos/categorizar', [ProductoController::class, 'categorizar'])->name('productos.categorizar');
Route::post('/productos/categorizar', [ProductoController::class, 'guardarCategorias'])->name('productos.categorizar.guardar');
Route::post( '/productos/asignar-categoria', [ProductoController::class, 'asignarCategoria'])->name('productos.asignarCategoria');
Route::get('/api/producto-categoria/por-categoria',  [ProductoCategoriaController::class, 'porCategoria'])->name('productos.productosPorCategoria');

Route::get('/logout', function () {
    session()->flush();
    return redirect()->route('inicio');
})->name('logout');

Route::get('/tienda', [ProductoController::class, 'catalogo'])->name('tienda.catalogo');



//Rutas modulo de Usuarios
Route::get('/usuarioVista', [UsuariosController::class,'index'])->name('usuariosVista');

Route::get('/usuarios/clientes',[UsuariosController::class, 'consultarClientes'])->name('clientes.consultar');
Route::match(['get','post'], '/usuarios/clientes/agregar', [UsuariosController::class, 'agregarCliente'])->name('clientes.agregar');
Route::match(['get','post'], '/usuarios/clientes/editar', [UsuariosController::class, 'editarEliminarCliente'])->name('clientes.editar');
Route::get('/usuarios/clientes/buscar/{id}', [UsuariosController::class, 'buscarCliente']);
Route::get('/usuarios/clientes/{id}', [UsuariosController::class, 'buscarCliente']);
Route::get('/cliente/productos', [ProductoController::class, 'panelCliente'])->name('cliente.Productos');
Route::get('/cliente/productos', [ProductoController::class, 'todosProductos'])->name('cliente.todosProductos');


Route::get('/usuarios/empleados', [UsuariosController::class, 'consultarEmpleados'])->name('empleados.consultar');
Route::match(['get','post'], '/usuarios/empleados/agregar', [UsuariosController::class, 'agregarEmpleado'])->name('empleados.agregar');
Route::match(['get','post'], '/usuarios/empleados/editar', [UsuariosController::class, 'editarEliminarEmpleado'])->name('empleados.editar');
Route::get('/usuarios/empleados/buscar/{id}', [UsuariosController::class, 'buscarEmpleado']);
Route::match(['get','post'],'/usuarios/cliente/registrar',[UsuariosController::class,'registrarCliente'])->name('cliente.registrar');
Route::get('/forgot-password', [AuthController::class, 'mostrarFormularioCodigo'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'enviarCodigo'])->name('password.email');
Route::get('/reset-password', [AuthController::class, 'mostrarFormularioReset'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'actualizarContrasena'])->name('password.update');
Route::get('/cliente/lista-deseos', [ListaDeseosController::class, 'index'])->name('cliente.listaDeseos');
Route::post('/cliente/lista-deseos/agregar', [ListaDeseosController::class, 'agregar'])->name('cliente.listaDeseos.agregar');
Route::delete('/cliente/lista-deseos/{idLista}', [ListaDeseosController::class, 'eliminar'])->name('cliente.listaDeseos.eliminar');
Route::get('/cliente/productos', [ListaDeseosController::class, 'productos'])->name('cliente.productos');

Route::get('/cliente/cupones', [ClienteCuponController::class, 'index'])->name('cliente.cupones');
Route::get('/usuario/mis-cupones', [CuponController::class, 'misCupones'])->name('usuario.mis_cupones');
Route::post('/usuario/cupon/redimir', [CuponController::class, 'redimir'])->name('usuario.cupon.redimir');

//Rutas modulo ventas

Route::middleware('cliente')->group(function () {

    // Carrito
    Route::get('/carrito', [CarritoController::class, 'index'])
        ->name('ventas.carrito.index');

    Route::post('/carrito', [CarritoController::class, 'store'])
        ->name('carrito.store');

    Route::put('/carrito/cantidad', [CarritoController::class, 'updateCantidad'])
        ->name('carrito.update');

    Route::delete('/carrito/eliminar', [CarritoController::class, 'eliminar'])
        ->name('carrito.delete');

    Route::post('/carrito/checkout', [CarritoController::class, 'checkout'])
        ->name('carrito.checkout');
    
     Route::get('/carrito/confirmar', [CarritoController::class, 'confirmar'])
    ->name('carrito.confirmar');

    // Pedidos
    Route::get('/mis-pedidos', [PedidoController::class, 'historial'])
        ->name('checkout.historial');

    Route::get('/mis-pedidos/{id}', [PedidoController::class, 'detalle'])
        ->name('pedido.detalle');


});

Route::middleware('admin')->group(function () {

    Route::get('/admin/pedidos', [AdminPedidoController::class, 'index'])
        ->name('ventas.pedidos');

    Route::get('/admin/envios', [AdminEnvioController::class, 'index'])
        ->name('ventas.envios');
    
    Route::get('/admin/pedidos/{id}', [AdminPedidoController::class, 'detalle'])
        ->name('admin.pedido.detalle');

});





