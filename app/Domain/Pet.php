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

    public static function createFromString(string $string): self
    {
        $json = json_decode($string, true);
        return new self($json['id'], $json['name']);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}