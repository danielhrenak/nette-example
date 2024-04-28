<?php

namespace App\Domain\Pets;

use App\Domain\Pets\ValueObject\Identifier;
use App\Domain\Pets\ValueObject\Name;
use App\Domain\Pets\ValueObject\Status;
use Nette\Utils\Json;

class Pet
{
    public function __construct(
        private Identifier $id,
        private Name $name,
        private Status $status
    )
    {

    }

    public static function createFromString(string $string): self
    {
        $array = Json::decode($string, true);
        return self::createFromArray($array);
    }

    public static function createFromArray(array $array): self
    {
        $id = Identifier::createFromString($array['id']);
        $name = Name::create($array['name']);
        $status = Status::createFromValue($array['status']);

        return new self($id, $name, $status);
    }

    public function getId(): int
    {
        return $this->id->getValue();
    }

    public function getName(): string
    {
        return $this->name->getValue();
    }

    public function getStatus(): string
    {
        return $this->status->getValue();
    }
}