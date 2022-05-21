<?php

namespace App\Exceptions\Instructions;

use Exception;
use Throwable;

class InvalidPlateauCoordinates extends Exception
{
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        $message = $message ?: __('exceptions.instructions.invalid_plateau_coordinates');
        parent::__construct($message, $code, $previous);
    }
}
