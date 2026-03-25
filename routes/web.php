<?php

use App\Http\Controllers\AdminPedidoController;
use App\Http\Controllers\CuponController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminEnvioController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsletterController;
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
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\Usuario\ClientesController;
use App\Http\Controllers\Usuario\EmpleadosController;
use App\Http\Controllers\ContactoController;


Route::get('/ventas', function () {return view('ventas.ventas');})->name('ventas.ventas');


Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/catalogovista', [ProductoController::class, 'vistacatalogo'])->name('productos.vistaCatalogo');
Route::get('/productos/categorizar', [ProductoController::class, 'categorizar'])->name('productos.categorizar');
Route::post('/productos/categorizar', [ProductoController::class, 'guardarCategorias'])->name('productos.categorizar.guardar');
Route::post( '/productos/asignar-categoria', [ProductoController::class, 'asignarCategoria'])->name('productos.asignarCategoria');
Route::get('/api/producto-categoria/por-categoria',  [ProductoCategoriaController::class, 'porCategoria'])->name('productos.productosPorCategoria');
Route::get('/producto/{id}', [ProductoController::class, 'detalle'])->name('producto.detalle');
Route::get('/producto/{id}', [ProductoController::class, 'detalle']) ->name('producto.detalle');
Route::get('/productos/buscar', [ProductoController::class, 'listar'])->name('productos.buscar');
Route::get('/productos/editar-categoria/{id}', [ProductoController::class, 'editarCategoria'])->name('productos.editarCategoria');
Route::post('/productos/editar-categoria/{id}', [ProductoController::class, 'actualizarCategoria'])->name('productos.actualizarCategoria');
Route::get('/categorias', [ProductoController::class, 'gestionCategorias'])->name('categorias.index');
Route::get('/productos/buscar', [ProductoController::class, 'listar'])->name('productos.buscar');
Route::get('/producto/{id}', [ProductoController::class, 'detalle'])->name('producto.detalle');


Route::get('/tienda', [ProductoController::class, 'catalogo'])->name('tienda.catalogo');


Route::get('/', [InicioController::class, 'index'])->name('inicio');
Route::view('/faq', 'Footer.faq')->name('faq');
Route::view('/terminos', 'Footer.terminos')->name('terminos');
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');
Route::post('/contacto', [ContactoController::class, 'enviar'])->name('contacto.enviar');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'mostrarFormulario'])->name('login');
Route::post('/login', [LoginController::class, 'manejarPeticion'])->name('login.procesar');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::get('/forgot-password', [AuthController::class, 'mostrarFormularioCodigo'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'enviarCodigo'])->name('password.email');
Route::get('/reset-password', [AuthController::class, 'mostrarFormularioReset'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'actualizarContrasena'])->name('password.update');
Route::post('/reenviar-codigo', [AuthController::class, 'enviarCodigo'])->name('password.enviar.codigo');
Route::match(['get','post'],'/usuarios/cliente/registrar',[ClientesController::class,'registrarCliente'])->name('cliente.registrar');
Route::get('/usuarios/cliente/verificar', [ClientesController::class, 'mostrarVistaVerificacion'])->name('registro.verificar');
Route::post('/usuarios/cliente/verificar/confirmar',[ClientesController::class, 'confirmarCodigoRegistro'])->name('registro.confirmar');
Route::post('/usuarios/cliente/verificar/reenviar',[ClientesController::class, 'reenviarCodigoRegistro'])->name('registro.reenviar');


Route::middleware(['verificar.sesion'])->group(function () {
    // PROVEEDORES
    Route::get('/proveedores', function () { return view('Proveedor.proveedores');});

    Route::get('/proveedores/consultar', [ProveedorController::class, 'index'])->name('proveedor.consultar');
    Route::get('/proveedores/agregar', [ProveedorController::class, 'create'])->name('proveedor.agregar');
    Route::post('/proveedores/guardar', [ProveedorController::class, 'guardar'])->name('proveedor.guardar');
    Route::post('/proveedor/buscar', [ProveedorController::class, 'buscar']) ->name('proveedor.buscar');
    Route::get('/proveedor/editar', [ProveedorController::class, 'editView'])->name('proveedor.editar');
    Route::put('/proveedor/update', [ProveedorController::class, 'update']) ->name('proveedor.update');
    Route::delete('/proveedor/eliminar', [ProveedorController::class, 'eliminar']) ->name('proveedor.eliminar');

    //PRODUCTOS
    Route::get('/productos/agregar', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/productos/agregar', [ProductoController::class, 'store'])->name('productos.store');

    Route::get('/productos/editar/{id}', [ProductoController::class, 'edit'])->name('productos.edit');
    Route::put('/productos/editar/{id}', [ProductoController::class, 'update'])->name('productos.update');
    Route::delete('/productos/eliminar/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

    Route::post('/categorias', [ProductoController::class, 'crearCategoria'])->name('categorias.store');
    Route::get('/categorias/editar/{id}', [ProductoController::class, 'editarCategoriaForm'])->name('categorias.edit');
    Route::put('/categorias/editar/{id}', [ProductoController::class, 'actualizarCategoriaForm'])->name('categorias.update');
    Route::delete('/categorias/eliminar/{id}', [ProductoController::class, 'eliminarCategoria'])->name('categorias.destroy');
    Route::get('/productos/editar-categoria/{id}', [ProductoController::class, 'editarCategoria'])->name('productos.editarCategoria');
    Route::post('/productos/editar-categoria/{id}', [ProductoController::class, 'actualizarCategoria'])->name('productos.actualizarCategoria');
    Route::get('/api/producto-categoria/por-categoria',  [ProductoCategoriaController::class, 'porCategoria'])->name('productos.productosPorCategoria');
    Route::get('/productos/categorizar', [ProductoController::class, 'categorizar'])->name('productos.categorizar');
    Route::post('/productos/categorizar', [ProductoController::class, 'guardarCategorias'])->name('productos.categorizar.guardar');
    Route::post( '/productos/asignar-categoria', [ProductoController::class, 'asignarCategoria'])->name('productos.asignarCategoria');
    Route::get('/productos/catalogo', [ProductoController::class, 'catalogo'])->name('productos.catalogo');


    //Cupones
    Route::get('/cupon', [CuponController::class, 'index'])->name('cupon.inventarioVista');
    Route::get('/cupon/consultar', [CuponController::class, 'consultar'])->name('cupon.consultar');
    Route::get('/cupon/agregar', [CuponController::class, 'create'])->name('cupon.agregar');
    Route::match(['get', 'post'],'/cupon/guardar', [CuponController::class, 'store'])->name('cupon.guardar');
    Route::get('/cupon/editar', [CuponController::class, 'editarVista'])->name('cupon.editarVista');
    Route::put('/cupon/editar', [CuponController::class, 'update'])->name('cupon.update');
    Route::delete('/cupon/eliminar', [CuponController::class, 'destroy'])->name('cupon.eliminar');
    Route::put('/cupon/editar', [CuponController::class, 'update'])->name('cupon.update');
    Route::delete('/cupon/eliminar', [CuponController::class, 'destroy'])->name('cupon.eliminar');
    Route::post('/carrito/cupon/aplicar', [CarritoController::class, 'aplicarCupon'])->name('carrito.cupon.aplicar');
Route::get('/carrito/cupon/quitar', [CarritoController::class, 'quitarCupon'])->name('carrito.cupon.quitar');

    //Asignar cupon a cliente

    Route::get('/cupon/asignar', [CuponController::class, 'asignarVista'])->name('cupon.asignarVista');
    Route::post('/cupon/asignar', [CuponController::class, 'asignar'])->name('cupon.asignar');
    Route::get('/usuario/mis-cupones/{idCliente}', [CuponController::class, 'apiMisCupones']);  

    //GESTION DE INVENTARIO
    Route::get('/inventario/productos', [ProductoController::class, 'inventario'])->name('productos.inventario');

    //REPORTES
    Route::get('/admin/reportes/ventas', [PedidoController::class, 'estadisticasVentas'])->name('reportes.ventas');
    Route::get('/admin/reportes/productos', [PedidoController::class, 'productosMasVendidos'])->name('reportes.productos');
    Route::get('/admin/reportes/clientes', [PedidoController::class, 'clientesFrecuentes'])->name('reportes.clientes');
    Route::get('/admin/reportes/cupones', [PedidoController::class, 'efectividadCupones'])->name('reportes.cupones');

    //Rutas modulo de Usuarios
    Route::get('/panel/admin', [AdminController::class, 'panel'])->name('panel.admin');

    Route::get('/usuarioVista', [EmpleadosController::class,'index'])->name('usuariosVista');
    Route::get('usuarios/panel/perfiles/perfilAdmin', [AdminController::class, 'perfilAdmin'])->name('admin.perfil');
    Route::get('usuarios/panel/perfiles/editarPerfilAdmin',[AdminController::class, 'editarPerfilAdmin'])->name('admin.perfil.editar');
    Route::post('usuarios/panel/perfiles/actualizarPerfilAdmin',[AdminController::class, 'actualizarPerfilAdmin'])->name('admin.perfil.actualizar');
    Route::get('/panel/vendedor', [VendedorController::class, 'panel'])->name('panel.vendedor');
    Route::get('/panel/vendedor/perfil', [VendedorController::class, 'perfil'])->name('vendedor.perfil');
    Route::get('/panel/vendedor/perfil', [VendedorController::class, 'perfilVendedor'])->name('vendedor.perfil');
    Route::get('/panel/vendedor/perfil/editar', [VendedorController::class, 'editarPerfilVendedor'])->name('vendedor.perfil.editar');
    Route::post('/panel/vendedor/perfil/actualizar', [VendedorController::class, 'actualizarPerfilVendedor'])->name('vendedor.perfil.actualizar');
    Route::get('/cliente/panel', [ClienteController::class, 'panel'])->name('panel.cliente');
    Route::get('/cliente/perfil', [ClienteController::class, 'perfil'])->name('cliente.perfil');
    Route::get('/panel/cliente/perfil/editar', [ClienteController::class, 'editarPerfil'])->name('cliente.perfil.editar');
    Route::post('/panel/cliente/perfil/actualizar', [ClienteController::class, 'actualizarPerfil'])->name('cliente.perfil.actualizar');
    Route::get('/cliente/productos', [ProductoController::class, 'panelCliente'])->name('cliente.Productos');
    Route::get('/cliente/productos', [ProductoController::class, 'todosProductos'])->name('cliente.todosProductos');

     //Rutas modulo de Usuarios
    Route::prefix('clientes')->group(function () {

        Route::get('/', [ClientesController::class, 'consultarClientes'])->name('clientes.consultar');
        Route::match(['get','post'], '/agregar', [ClientesController::class, 'agregarCliente'])->name('clientes.agregar');
        Route::get('/editar/{id}', [ClientesController::class, 'mostrarEditarCliente'])->name('clientes.editar.form');
        Route::post('/actualizar', [ClientesController::class, 'actualizarCliente'])->name('clientes.update');
        Route::delete('/eliminar/{id}', [ClientesController::class, 'eliminarCliente'])->name('clientes.eliminar');
        Route::get('/buscar/{id}', [ClientesController::class, 'buscarCliente']);
        Route::get('/historial', [ClientesController::class, 'historial'])->name('cliente.historial');

    });
    Route::prefix('registro')->group(function () {

        Route::match(['get','post'], '/', [ClientesController::class, 'registrarCliente'])->name('cliente.registro');
        Route::get('/verificar', [ClientesController::class, 'mostrarVistaVerificacion'])->name('registro.verificar');
        Route::post('/confirmar', [ClientesController::class, 'confirmarCodigoRegistro'])->name('registro.confirmar');
        Route::post('/reenviar', [ClientesController::class, 'reenviarCodigoRegistro'])->name('registro.reenviar');

    });
    Route::prefix('empleados')->group(function () {

        Route::get('/', [EmpleadosController::class, 'consultarEmpleados'])->name('empleados.consultar');
        Route::match(['get','post'], '/agregar', [EmpleadosController::class, 'agregarEmpleado'])->name('empleados.agregar');
        Route::get('/editar/{id}', [EmpleadosController::class, 'mostrarEditarEmpleado'])->name('empleado.editar.form');
        Route::post('/actualizar', [EmpleadosController::class, 'actualizarEmpleado'])->name('empleados.editar');
        Route::delete('/eliminar/{id}', [EmpleadosController::class, 'eliminarEmpleado'])->name('empleado.eliminar');
        Route::get('/buscar/{id}', [EmpleadosController::class, 'buscarEmpleado']);
        Route::get('/verificar', function () {return view('Usuario.Empleado.EmpleadoVerificar');})->name('empleados.verificarVista');
        Route::post('/verificar', [EmpleadosController::class, 'verificarEmpleado'])->name('empleados.verificar');

    });
    Route::get('/empleado/configuracion', [EmpleadosController::class, 'configuracion'])->name('empleado.configuracion');
    Route::post('/empleado/cambiar-password', [EmpleadosController::class, 'cambiarPassword'])->name('empleado.cambiar.password');




    Route::get('/cliente/lista-deseos', [ListaDeseosController::class, 'index'])->name('cliente.listaDeseos');
    Route::post('/cliente/lista-deseos/agregar', [ListaDeseosController::class, 'agregar'])->name('cliente.listaDeseos.agregar');
    Route::delete('/cliente/lista-deseos/{idLista}', [ListaDeseosController::class, 'eliminar'])->name('cliente.listaDeseos.eliminar');
    Route::get('/cliente/productos', [ListaDeseosController::class, 'productos'])->name('cliente.productos');
    Route::get('/cliente/cupones', [CuponController::class, 'misCupones'])->name('cliente.cupones');
    Route::post('/usuario/cupon/redimir', [CuponController::class, 'redimir'])->name('usuario.cupon.redimir');



    //Rutas modulo ventas
    Route::middleware('cliente')->group(function () {

        // Carrito
        Route::get('/carrito', [CarritoController::class, 'index'])->name('ventas.carrito.index');
        Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
        Route::put('/carrito/cantidad', [CarritoController::class, 'updateCantidad'])->name('carrito.update');
        Route::delete('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.delete');
        Route::post('/carrito/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');
        Route::get('/carrito/confirmar', [CarritoController::class, 'confirmar'])->name('carrito.confirmar');

        // Pedidos
        Route::get('/mis-pedidos', [PedidoController::class, 'historial'])->name('checkout.historial');
        Route::get('/mis-pedidos/{id}', [PedidoController::class, 'detalle'])->name('pedido.detalle');
        Route::get('/pedido/{id}/comprobante', [PedidoController::class, 'comprobante'])->name('pedido.comprobante');
        Route::get('/pedido/{id}/comprobante/pdf', [PedidoController::class, 'comprobantePdf'])->name('pedido.comprobante.pdf');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/admin/pedidos', [AdminPedidoController::class, 'index'])->name('ventas.pedidos');
        Route::get('/admin/envios', [AdminEnvioController::class, 'index'])->name('ventas.envios');
        Route::get('/admin/pedidos/{id}', [AdminPedidoController::class, 'detalle'])->name('admin.pedido.detalle');
        Route::post('/admin/pedido/{id}/estado', [AdminPedidoController::class, 'cambiarEstado'])->name('admin.pedido.estado');
        Route::put('/admin/envios/{id}', [AdminEnvioController::class, 'cambiarEstado'])->name('admin.envio.estado');
    });
});
