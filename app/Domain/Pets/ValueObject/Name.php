<?php

namespace App\Domain\Pets\ValueObject;

class Name
{
    public function __construct(private string $id)
    {
    }

    public static function create(string $id): self
    {
        return new self($id);
    }

    public function getValue(): string
    {
        return $this->id;
    }
}