<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class CodigoRecuperacionMail extends Mailable
{
    public $codigo;
    public $correo;
    public $nombre;

    public function __construct($codigo, $correo, $nombre)
    {
        $this->codigo = $codigo;
        $this->correo = $correo;
        $this->nombre = $nombre;
    }

    public function build()
    {
        return $this->subject('Recuperación de contraseña - KSHOP')
                    ->view('emails.codigo_recuperacion');
    }
}