<?php

namespace App\Enums;

enum Movement: string
{
    case Left = 'L';
    case Right = 'R';
    case Move = 'M';

    public function isTurningMovement(): bool
    {
        return $this === self::Right || $this === self::Left;
    }
}
