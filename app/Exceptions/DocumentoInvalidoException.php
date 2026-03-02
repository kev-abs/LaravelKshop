<?php

namespace App\Exceptions;

use Exception;

class DocumentoInvalidoException extends Exception
{
    protected $message = 'El documento ingresado es inválido o ya existe.';
}