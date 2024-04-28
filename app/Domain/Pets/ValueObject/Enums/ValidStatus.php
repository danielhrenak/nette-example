<?php

namespace App\Domain\Pets\ValueObject\Enums;

enum ValidStatus: string
{
    case AVAILABLE = 'available';
    case PENDING = 'pending';
    case SOLD = 'sold';

    public static function isValid(string $status): bool
    {
        foreach (self::cases() as $case) {
            if ($case->value === $status) {
                return true;
            }
        }
        return false;
    }
}
