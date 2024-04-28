<?php

namespace App\Domain\Pets\Exceptions;

use App\Domain\Pets\Pet;
use InvalidArgumentException;

class PetDoesNotExistsException extends InvalidArgumentException
{
    public function __construct(Pet $pet, $message = "Pet does not exists", $code = 500, \Throwable $previous = null)
    {
        $message = "Pet with id {$pet->getId()} does not exists";
        parent::__construct($message, $code, $previous);
    }
}

