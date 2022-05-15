<?php

namespace App\Entities;

class Plateau
{
    private array $occupiedPositions;

    public function __construct(
        private PlateauCoordinates $coordinates
    ) {
        $this->occupiedPositions = [];
    }

    public function positionIsValid(Position $position): bool
    {
        return $position->getX() >= $this->coordinates->getXBottomLeftCoordinate() &&
            $position->getX() <= $this->coordinates->getXUpperRightCoordinate() &&
            $position->getY() >= $this->coordinates->getYBottomLeftCoordinate() &&
            $position->getY() <= $this->coordinates->getYUpperRightCoordinate();
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
