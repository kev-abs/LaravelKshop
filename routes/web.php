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

