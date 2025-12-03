<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Producto\Controller;
class InicioController 
{
    public function index()
    {
        return view('inicio');
    }
}
