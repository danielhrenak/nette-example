<?php

namespace App\Domain\Pets\Exceptions;

use App\Domain\Pets\Pet;
use InvalidArgumentException;

class PetNotFoundException extends InvalidArgumentException
{
    public function __construct(Pet $pet, $message = "Pet not found", $code = 404, \Throwable $previous = null)
    {
        $message = "Pet with id {$pet->getId()} not found";
        parent::__construct($message, $code, $previous);
    }
}

