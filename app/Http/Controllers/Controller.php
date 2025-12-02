<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Controller
{
    public function index() {
        return view('productos.index');
    }

    public function create() {
        return view('productos.create');
    }

    public function edit($id) {
        return view('productos.edit', compact('id'));
    }
}
