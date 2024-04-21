<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Presenters\Exceptions\MethodNotAllowedException;
use JetBrains\PhpStorm\NoReturn;
use Nette;


final class PetPresenter extends Nette\Application\UI\Presenter
{
    #[NoReturn]
    public function renderDefault(): void
    {
        match ($this->getHttpRequest()->getMethod()) {
            'PUT' => $this->update(),
            'POST' => $this->add(),
            default => MethodNotAllowedException::create(),
        };
    }


    private function add():void
    {
        var_dump('POST');
        die();
    }

    private function update():void
    {
        var_dump('PUT');
        die();
    }
}
