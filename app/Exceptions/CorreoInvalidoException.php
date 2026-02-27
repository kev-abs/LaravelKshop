<?php

namespace App\Exceptions;

use Exception;

class CorreoInvalidoException extends Exception
{
    protected $message = 'El correo electrónico ingresado no es válido o ya está en uso.';
}