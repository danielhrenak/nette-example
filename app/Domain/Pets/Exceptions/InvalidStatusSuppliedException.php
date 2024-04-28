<?php

namespace App\Domain\Pets\Exceptions;

class InvalidStatusSuppliedException extends \Exception
{

    public function __construct(string $message = "Invalid status", int $code = 405, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}