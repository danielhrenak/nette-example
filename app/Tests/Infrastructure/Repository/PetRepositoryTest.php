<?php

namespace App\Tests\Infrastructure\Repository;

use App\Domain\Pets\Exceptions\InvalidStatusSuppliedException;
use App\Domain\Pets\Exceptions\PetAlreadyExistsException;
use App\Domain\Pets\Pet;
use App\Infrastructure\Repository\PetRepository;
use App\Infrastructure\Repository\XmlRepository;
use PHPUnit\Framework\TestCase;
use SimpleXMLElement;

class PetRepositoryTest extends TestCase
{
    private $xmlRepository;
    private $petRepository;

    protected function setUp(): void
    {
        $this->xmlRepository = $this->createMock(XmlRepository::class);
        $this->petRepository = new PetRepository($this->xmlRepository);
    }

    protected function tearDown(): void
    {
        if (file_exists('pets.xml')) {
            unlink('pets.xml');
        }
    }

    public function testAddingPetStoresPetInXmlRepository(): void
    {
        $pet = new Pet(1, 'Rex', 'available');
        $this->xmlRepository->method('getXml')->willReturn(new SimpleXMLElement('<pets/>'));
        $this->xmlRepository->method('getXmlFile')->willReturn('pets.xml');

        $this->petRepository->add($pet);

        $this->assertTrue(file_exists('pets.xml'));
    }

    public function testAddingTheSamePetInXmlRepository(): void
    {
        $this->expectException(PetAlreadyExistsException::class);

        $this->xmlRepository->method('getXml')->willReturn(new SimpleXMLElement('<pets><pet><id>1</id><name>Rex</name></pet></pets>'));
        $this->xmlRepository->method('getXmlFile')->willReturn('pets.xml');

        $pet = new Pet(1, 'Rex');

        $this->petRepository->add($pet);
    }

    public function testAddingPetUpdatesExistingXmlRepository(): void
    {
        $pet = new Pet(2, 'Felix', 'sold');
        $this->xmlRepository->method('getXml')->willReturn(new SimpleXMLElement('<pets><pet><id>1</id><name>Rex</name></pet></pets>'));
        $this->xmlRepository->method('getXmlFile')->willReturn('pets.xml');

        $this->petRepository->add($pet);

        $xml = simplexml_load_file('pets.xml');
        $this->assertEquals(2, count($xml->pet));
    }

    public function testAddingNotExistingStatus(): void
    {
        $this->expectException(InvalidStatusSuppliedException::class);

        $pet = Pet::createFromArray(['id' => 111, 'name' => 'Rex', 'status' => 'invalid']);
        $this->xmlRepository->method('getXml')->willReturn(new SimpleXMLElement('<pets/>'));
        $this->xmlRepository->method('getXmlFile')->willReturn('pets.xml');

        $this->petRepository->add($pet);

        $this->assertTrue(file_exists('pets.xml'));
    }
}