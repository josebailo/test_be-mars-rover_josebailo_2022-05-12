<?php

namespace App\Entities;

use App\Enums\CardinalPoint;
use App\Enums\Movements;

class Rover
{
    public function __construct(
        private Position $position,
        private CardinalPoint $facing,
        private array $movements = [],
    ) { }

    // TODO find better name
    public function getStatus(): string
    {
        return "{$this->position->getX()} {$this->position->getY()} {$this->facing->value}";
    }

    public function getNextPosition(): Position
    {
        $nextMovement = $this->movements[0];

        // if the rover only turns the position will be the same
        if ($nextMovement === Movements::Right || $nextMovement === Movements::Left) {
            return $this->position;
        }

        if ($nextMovement === Movements::Move) {
            $x = $this->position->getX();
            $y = $this->position->getY();

            switch ($this->facing) {
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
}
