<?php

namespace App\Domain\Pets\ValueObject;

use App\Domain\Pets\Exceptions\InvalidStatusSuppliedException;
use App\Domain\Pets\ValueObject\Enums\ValidStatus;

class Status
{
    public function __construct(private string $value)
    {
    }

    public static function createFromValue(string $value): self
    {
        if (!ValidStatus::isValid($value)) {
            throw new InvalidStatusSuppliedException();
        }
        return new self ($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}