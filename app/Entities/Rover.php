<?php

namespace App\Entities;

use App\Enums\CardinalPoint;
use App\Enums\Movements;

class Rover
{
    public function __construct(
        private Position $position,
        private CardinalPoint $heading,
        private array $movements = [],
    ) { }

    public function getSituation(): string
    {
        return "{$this->position->getX()} {$this->position->getY()} {$this->heading->value}";
    }

    public function getNextPosition(): Position
    {
        $nextMovement = $this->movements[0];

        // if the rover only turns the position will be the same
        if ($nextMovement->isTurningMovement()) {
            return $this->position;
        }

        if ($nextMovement === Movements::Move) {
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

        throw new \Error('Movement unknown!');
    }

    public function move(): void
    {
        $nextMovement = $this->movements[0];

        if ($nextMovement->isTurningMovement()) {
            if ($nextMovement === Movements::Right) {
                $this->heading = $this->heading->nextPointTurningRight();
            } else {
                $this->heading = $this->heading->nextPointTurningLeft();
            }
        } else {
            $this->position = $this->getNextPosition();
        }

        array_shift($this->movements);
    }
}
