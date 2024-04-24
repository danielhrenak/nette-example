<?php

namespace App\Infrastructure\Repository;

use App\Domain\Pet;

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
        $xml = $this->xmlRepository->getXml();
        $petElement = $xml->addChild('pet');
        $petElement->addChild('id', $pet->getId());
        $petElement->addChild('name', $pet->getName());
        $xml->asXML($this->xmlRepository->getXmlFile());
    }
}