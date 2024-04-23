<?php

namespace App\Domain;

class Pet
{
    public function __construct(
        private int $id,
        private string $name
    )
    {

    }
}