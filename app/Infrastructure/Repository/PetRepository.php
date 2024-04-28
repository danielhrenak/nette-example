<?php

namespace App\Infrastructure\Repository;

use App\Domain\Pets\Exceptions\PetAlreadyExistsException;
use App\Domain\Pets\Exceptions\PetNotFoundException;
use App\Domain\Pets\Pet;

class PetRepository implements DomainRepositoryInterface
{

    public XmlRepository $xmlRepository;

    public function __construct(XmlRepository $xmlRepository)
    {
        $this->xmlRepository = $xmlRepository;
    }

    public static function createRepository(XmlRepository $xmlRepository): self
    {
        return new self($xmlRepository);
    }

    public function add(Pet $pet): void
    {
        if ($this->doesPetIdExists($pet->getId())) {
            throw new PetAlreadyExistsException($pet);
        }

        $xml = $this->xmlRepository->getXml();
        $petElement = $xml->addChild('pet');
        $petElement->addChild('id', $pet->getId());
        $petElement->addChild('name', $pet->getName());
        $petElement->addChild('status', $pet->getStatus());
        $xml->asXML($this->xmlRepository->getXmlFile());
    }

    public function update(Pet $pet): void
    {
        if (!$this->doesPetIdExists($pet->getId())) {
            throw new PetNotFoundException($pet);
        }

        $xml = $this->xmlRepository->getXml();
        $petElement = $xml->xpath("//pet[id={$pet->getId()}]")[0];
        $petElement->name = $pet->getName();
        $petElement->status = $pet->getStatus();
        $xml->asXML($this->xmlRepository->getXmlFile());
    }

    private function doesPetIdExists($id): bool
    {
        $xml = $this->xmlRepository->getXml();
        foreach ($xml->pet as $pet) {
            if ($pet->id == $id) {
                return true;
            }
        }
        return false;
    }
}