<?php

namespace App\Exceptions;

use Exception;

class TelefonoInvalidoException extends Exception
{
    protected $message = 'El número de teléfono no cumple con el formato requerido.';
}