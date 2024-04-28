<?php

namespace App\Domain\Pets\ValueObject;

class Tag
{

    public function __construct(
        private int $id,
        private string $name
    ) {

    }
}