<?php

namespace App\Entities;

class Plateau
{
    private array $occupiedPositions;

    public function __construct(
        private int $xUpperRightCoordinate,
        private int $yUpperRightCoordinate,
    ) {
        $this->occupiedPositions = [];
    }

    public function positionIsValid(Position $position): bool
    {
        return $position->getX() >= 0 && $position->getX() <= $this->xUpperRightCoordinate &&
            $position->getY() >= 0 && $position->getY() <= $this->yUpperRightCoordinate;
    }

    public function setOccupiedPositions(array $positions): void
    {
        $this->occupiedPositions = $positions;
    }

    public function positionIsOccupied(Position $position): bool
    {
        foreach ($this->occupiedPositions as $occupiedPosition) {
            if ($occupiedPosition->is($position)) {
                return true;
            }
        }

        return false;
    }
}
