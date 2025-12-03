<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EnvioController;

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


Route::get('/ventas', function () {
    return view('ventas.ventas');
});


Route::get('/envios', [EnvioController::class, 'index'])->name('ventas.envios');

Route::post('/envios', [EnvioController::class, 'store'])->name('envios.store');
Route::put('/envios/{id}', [EnvioController::class, 'update'])->name('envios.update');
Route::delete('/envios/{id}', [EnvioController::class, 'destroy'])->name('envios.destroy');



