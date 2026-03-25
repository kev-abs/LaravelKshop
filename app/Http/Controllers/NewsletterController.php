<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class NewsletterController
{
    public function store(Request $request)
    {
        $request->validate([
            'correo' => 'required|email|unique:newsletter,correo'
        ]);

        DB::table('newsletter')->insert([
            'correo' => $request->correo
        ]);

        // Traer productos para el correo
        $productos = DB::table('producto')->limit(3)->get();

        Mail::send('emails.newsletter', ['productos' => $productos], function ($message) use ($request) {
            $message->to($request->correo)
                    ->subject(' Bienvenido a K-SHOP');
        });

        return back()->with('success', '¡Suscripción exitosa!');
    }
}