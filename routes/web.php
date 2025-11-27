<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
    return "Hola, Laravel";
});

Route::get('/hola', function () {
    $nombre= "Santiago";
    return "Hola, Laravel {$nombre}";
});

Route::get('/cupon', function () {
    $cupon = DB::table('cupon')->get();
    return response()->json($cupon, 200, [], JSON_UNESCAPED_UNICODE);
});