<?php

namespace App\Exceptions\Instructions;

use Exception;
use Throwable;

class InvalidRoverSituation extends Exception
{
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        $message = $message ?: __('exceptions.instructions.invalid_rover_situation');
        parent::__construct($message, $code, $previous);
    }
}
