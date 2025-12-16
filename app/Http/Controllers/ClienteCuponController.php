<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteCuponController extends Controller
{
    public function index()
    {
        // Por ahora solo mostramos la vista
        return view('Usuario.cupones.index');
    }
}
