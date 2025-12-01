<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/prueba-db', function () {
    try {
        DB::connection()->getPdo();
        return "Conectado correctamente a la base de datos: " . DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "Error al conectar: " . $e->getMessage();
    }
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
    return "Hola, Laravel";
});
Route::get('/clientes', function () {
    $clientes = DB::table('cliente')->get();

    return response()->json($clientes, 200, [], JSON_UNESCAPED_UNICODE);
});
use App\Http\Controllers\ProductoController;

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/catalogo', [ProductoController::class, 'catalogo'])->name('productos.catalogo');

Route::get('/productos/agregar', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos/agregar', [ProductoController::class, 'store'])->name('productos.store');

Route::get('/productos/editar/{id}', [ProductoController::class, 'edit'])->name('productos.edit');
Route::put('/productos/editar/{id}', [ProductoController::class, 'update'])->name('productos.update');
