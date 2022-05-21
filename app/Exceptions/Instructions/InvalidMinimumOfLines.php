<?php

namespace App\Exceptions\Instructions;

use Exception;
use Throwable;

class InvalidMinimumOfLines extends Exception
{
    public function __construct(string $message = '', int $code = 0, ?Throwable $previous = null)
    {
        $message = $message ?: __('exceptions.instructions.invalid_minimum_of_lines');
        parent::__construct($message, $code, $previous);
    }
}
