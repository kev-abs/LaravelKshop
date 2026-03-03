<?php

namespace App\Exceptions;

use Exception;

class ContrasenaInvalidaException extends Exception
{
    protected $message = 'La contraseña es demasiado débil o está vacía.';
}