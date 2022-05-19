<?php

namespace App\Entities;

use App\Enums\Heading;

class Rover
{
    public function __construct(
        private Position $position,
        private Heading $heading,
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
            case Heading::North:
                $y++;
                break;
            case Heading::South:
                $y--;
                break;
            case Heading::East:
                $x++;
                break;
            case Heading::West:
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
