<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Domain\Pet;
use App\Infrastructure\Repository\PetRepository;
use App\Presenters\Exceptions\MethodNotAllowedException;
use JetBrains\PhpStorm\NoReturn;
use Nette;


final class PetPresenter extends Nette\Application\UI\Presenter
{

    public function __construct(private PetRepository $petRepository)
    {
    }

    #[NoReturn]
    public function renderDefault(): void
    {

        $pet = Pet::createFromString($this->getHttpRequest()->getRawBody());

        match ($this->getHttpRequest()->getMethod()) {
            'PUT' => $this->update(),
            'POST' => $this->add($pet),
            default => MethodNotAllowedException::create(),
        };
    }


    private function add(Pet $pet):void
    {
        $this->petRepository->add($pet);
    }

    private function update():void
    {
        var_dump('PUT');
        die();
    }
}
