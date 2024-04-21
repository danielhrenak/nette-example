<?php

namespace App\Presenters\Exceptions;

use Exception;

class MethodNotAllowedException extends Exception
{
    public function __construct($message = "Method not allowed", $code = 500, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function create()
    {
        return new self();
    }
}