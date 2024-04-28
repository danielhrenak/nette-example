<?php

namespace App\Domain\Pets\Exceptions;

use App\Domain\Pets\Pet;
use InvalidArgumentException;

class PetNotFoundException extends InvalidArgumentException
{
    public function __construct(int $id, $message = "Pet not found", $code = 404, \Throwable $previous = null)
    {
        $message = "Pet with id {$id} not found";
        parent::__construct($message, $code, $previous);
    }
}

