<?php

namespace App\Domain\Pets\Exceptions;

use App\Domain\Pets\Pet;
use InvalidArgumentException;

class PetAlreadyExistsException extends InvalidArgumentException
{
    public function __construct(Pet|null $pet, $message = "Pet already exists", $code = 405, \Throwable $previous = null)
    {
        $message = "Pet with id {$pet->getId()} already exists";
        parent::__construct($message, $code, $previous);
    }
}

