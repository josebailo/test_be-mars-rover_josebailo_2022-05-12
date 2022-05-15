<?php

namespace App\Entities;

use App\Enums\CardinalPoint;

class Rover
{
    public function __construct(
        private int $xCoordinate,
        private int $yCoordinate,
        private CardinalPoint $facing,
        private array $movements = [],
    ) { }

    public function getPosition(): string
    {
        return "{$this->xCoordinate} {$this->yCoordinate} {$this->facing->value}";
    }
}
