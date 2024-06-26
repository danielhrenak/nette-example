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
            throw new PetNotFoundException($pet->getId());
        }

        $xml = $this->xmlRepository->getXml();
        $petElement = $xml->xpath("//pet[id={$pet->getId()}]")[0];
        $petElement->name = $pet->getName();
        $petElement->status = $pet->getStatus();
        $xml->asXML($this->xmlRepository->getXmlFile());
    }

    public function get(int $id): Pet
    {
        $xml = $this->xmlRepository->getXml();
        foreach ($xml->pet as $pet) {
            if ($pet->id == $id) {
                return Pet::createFromArray(['id' => $pet->id, 'name' => $pet->name, 'status' => $pet->status]);
            }
        }
        throw new PetNotFoundException($id);
    }

    public function delete(int $id): void
    {
        if (!$this->doesPetIdExists($id)) {
            throw new PetNotFoundException($id);
        }

        $xml = $this->xmlRepository->getXml();
        $petElement = $xml->xpath("//pet[id={$id}]")[0];
        unset($petElement[0]);
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

    public function findByStatus(mixed $status): array
    {
        $xml = $this->xmlRepository->getXml();
        $pets = [];
        foreach ($xml->pet as $pet) {
            if ($pet->status->__toString() == $status) {
                $pets[] = Pet::createFromArray(['id' => $pet->id->__toString(), 'name' => $pet->name->__toString(), 'status' => $pet->status->__toString()]);
            }
        }
        return $pets;
    }
}