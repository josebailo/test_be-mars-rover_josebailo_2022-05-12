<?php

namespace App\Entities;

use App\Enums\CardinalPoint;

class Rover
{
    public function __construct(
        private Position $position,
        private CardinalPoint $facing,
        private array $movements = [],
    ) { }

    public function getPosition(): string
    {
        return "{$this->position->getX()} {$this->position->getY()} {$this->facing->value}";
    }
}
