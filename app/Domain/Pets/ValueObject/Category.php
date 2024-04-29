<?php

namespace App\Domain\Pets\ValueObject;

class Category
{
    public function __construct(private Identifier $id, private Name $name)
    {
    }
}