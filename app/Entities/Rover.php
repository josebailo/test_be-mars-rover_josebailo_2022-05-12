<?php

namespace App\Entities;

use App\Enums\CardinalPoint;

class Rover
{
    public function __construct(
        private Position $position,
        private CardinalPoint $heading,
    ) { }

    public function getSituation(): string
    {
        return "{$this->position->getX()} {$this->position->getY()} {$this->heading->value}";
    }

    public function getPosition(): Position
    {
        return $this->position;
    }

    public function getForwardPosition(): Position
    {
        $x = $this->position->getX();
        $y = $this->position->getY();

        switch ($this->heading) {
            case CardinalPoint::North:
                $y++;
                break;
            case CardinalPoint::South:
                $y--;
                break;
            case CardinalPoint::East:
                $x++;
                break;
            case CardinalPoint::West:
                $x--;
                break;
        }

        return new Position($x, $y);
    }

    public function moveForward(): void
    {
        $this->position = $this->getForwardPosition();
    }

    public function turnLeft(): void
    {
        $this->heading = $this->heading->nextPointTurningLeft();
    }

    public function turnRight(): void
    {
        $this->heading = $this->heading->nextPointTurningRight();
    }
}
