<?php

namespace App\Infrastructure\Repository;

interface DomainRepositoryInterface
{
    public function __construct(XmlRepository $xmlRepository);
}