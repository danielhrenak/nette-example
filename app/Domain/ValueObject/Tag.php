<?php

namespace App\Domain\ValueObject;

class Tag
{

    public function __construct(
        private int $id,
        private string $name
    ) {

    }
}