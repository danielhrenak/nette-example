<?php

namespace App\Domain\Pets\ValueObject;

use App\Domain\Pets\Exceptions\InvalidIDSuppliedException;

class Identifier
{
    public function __construct(private int $id)
    {
    }

    public static function createFromString(string $id): self
    {
        if (!is_numeric($id)) {
            throw new InvalidIDSuppliedException();
        }
        return new self($id);
    }

    public function getValue(): int
    {
        return $this->id;
    }
}