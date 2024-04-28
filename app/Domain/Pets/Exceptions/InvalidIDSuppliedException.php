<?php

namespace App\Domain\Pets\Exceptions;

use App\Domain\Pets\Pet;
use InvalidArgumentException;

class InvalidIDSuppliedException extends InvalidArgumentException
{
    public function __construct($message = "Invalid ID supplied", $code = 400, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

