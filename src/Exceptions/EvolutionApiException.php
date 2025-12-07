<?php

declare(strict_types=1);

namespace WallaceMartinss\FilamentEvolution\Exceptions;

use Exception;

class EvolutionApiException extends Exception
{
    public function __construct(
        string $message = 'Evolution API Error',
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
