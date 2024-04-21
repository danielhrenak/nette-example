<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;


/**
 * Handles HTTP error responses.
 */
final class ErrorPresenter extends Nette\Application\UI\Presenter
{
	// allow access via all HTTP methods
	public array $allowedMethods = [];


	public function renderDefault(Nette\Application\BadRequestException $exception): void
	{
		$this->template->httpCode = $exception->getCode();
		$this->template->exceptionMessage = $exception->getMessage();
		$this->template->setFile( __DIR__ . '/templates/Error/default.latte');
	}
}
