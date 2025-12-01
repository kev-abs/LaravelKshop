<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;

Route::get('/', [InicioController::class, 'index'])->name('inicio');

Route::get('/login', [LoginController::class, 'mostrarFormulario'])->name('login');

Route::post('/login', [LoginController::class, 'manejarPeticion'])->name('login.procesar');

// Paneles
Route::view('/panel/cliente', 'Usuario/panel.panelCliente')->name('Usuario.panel.panelCliente');
Route::view('/panel/admin', 'Usuario/panel.panelAdmin')->name('Usuario.panel.panelAdmin');
Route::view('/panel/vendedor', 'Usuario/panel.panelVendedor')->name('Usuario.panel.panelVendedor');