<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Domain\Pets\Pet;
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
            'PUT' => $this->update($pet),
            'POST' => $this->add($pet),
            default => MethodNotAllowedException::create(),
        };

        $this->template->array = ['status' => 'success'];
        $this->template->setFile(__DIR__ . '/templates/Pet/json.latte');
        $this->layout = false;
    }

    public function renderDetail(int $id): void
    {
        match ($this->getHttpRequest()->getMethod()) {
            'GET' => $this->get($id),
            'DELETE' => $this->delete($id),
            default => MethodNotAllowedException::create(),
        };

        $this->template->setFile(__DIR__ . '/templates/Pet/json.latte');
        $this->layout = false;
    }

    public function renderFindByStatus(): void
    {
        $status = $this->getHttpRequest()->getQuery('status');
        $pets = $this->petRepository->findByStatus($status);
        $this->template->array = [];
        foreach ($pets as $pet) {
            $this->template->array[] = $pet->toArray();
        }
        $this->template->setFile(__DIR__ . '/templates/Pet/json.latte');
        $this->layout = false;

    }


    private function add(Pet $pet):void
    {
        $this->petRepository->add($pet);
    }

    private function update(Pet $pet):void
    {
        $this->petRepository->update($pet);
    }

    private function get(int $id):void
    {
        $pet = $this->petRepository->get($id);
        $this->template->array = $pet->toArray();
    }

    private function delete(int $id):void
    {
        $pet = $this->petRepository->delete($id);
        $this->template->array = ['status' => 'success'];
    }
}
