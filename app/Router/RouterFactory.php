<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
    use Nette\StaticClass;

    public static function createRouter(): RouteList
    {
        $router = new RouteList;
        $router->addRoute('pet', ['presenter' => 'Pet', 'action' => 'default']);
        $router->addRoute('pet/findByStatus', ['presenter' => 'Pet', 'action' => 'findByStatus']);
        $router->addRoute('pet/<id>', ['presenter' => 'Pet', 'action' => 'detail', 'id' => null]);
        return $router;
    }
}
