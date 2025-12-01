<?php

use App\Http\Controllers\CuponController;

Route::get('/cupon', [CuponController::class, 'index'])->name('cupon.index');

Route::get('/cupon/agregar', [CuponController::class, 'create'])->name('cupon.agregar');
Route::post('/cupon/agregar', [CuponController::class, 'store'])->name('cupon.guardar');

Route::get('/cupon/editar', [CuponController::class, 'edit'])->name('cupon.editar');
Route::post('/cupon/actualizar', [CuponController::class, 'update'])->name('cupon.actualizar');

Route::post('/cupon/eliminar', [CuponController::class, 'destroy'])->name('cupon.eliminar');

Route::get('/inicio', function () {
    return view('inicio');
})->name('inicio');