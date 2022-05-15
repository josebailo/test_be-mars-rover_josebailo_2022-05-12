<?php

namespace App\Entities;

class Position
{
    public function __construct(
        private int $x,
        private int $y,
    ) { }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }

    public function is(Position $position): bool
    {
        return $this->getX() === $position->getX() && $this->getY() === $position->getY();
    }
}
