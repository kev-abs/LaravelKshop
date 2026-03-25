<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ContactoController
{
    public function index()
    {
        return view('Footer.contacto');
    }

    public function enviar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email',
            'mensaje' => 'required|string',
            'archivo' => 'nullable|file|max:15120'
        ]);

        try {
            $rutaArchivo = null;

            if ($request->hasFile('archivo')) {
                $rutaArchivo = $request->file('archivo')->store('contactos', 'public');
            }

            $contenido = "
            Nombre: {$request->nombre}
            Correo: {$request->correo}
            Tipo: {$request->tipo}
            Link: {$request->link}

            Mensaje:
            {$request->mensaje}
            ";

            Mail::raw($contenido, function ($message) use ($request, $rutaArchivo) {
                $message->to('kshopclientes@gmail.com')
                        ->subject("Nuevo contacto K-SHOP")
                        ->from($request->correo);

                if ($rutaArchivo) {
                    $message->attach(storage_path('app/public/' . $rutaArchivo));
                }
            });

            return back()->with('success', 'Mensaje enviado correctamente');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al enviar el mensaje');
        }
    }
}