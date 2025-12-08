<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class ClienteController 
{
    public function panel()
    {
        $productos = Producto::inRandomOrder()
            ->take(6) // cantidad de productos
            ->get();

        return view('Usuario.panel.panelCliente', compact('productos'));
    }
}

