<?php

namespace App\Entities;

use App\Exceptions\InvalidXUpperRightCoordinate;
use App\Exceptions\InvalidYUpperRightCoordinate;

class Plateau
{
    private int $xBottomLeftCoordinate = 0;
    private int $yBottomLeftCoordinate = 0;
    private array $occupiedPositions;

    public function __construct(
        private int $xUpperRightCoordinate,
        private int $yUpperRightCoordinate,
    ) {
        if ($xUpperRightCoordinate <= $this->xBottomLeftCoordinate) {
            throw new InvalidXUpperRightCoordinate;
        }

        if ($yUpperRightCoordinate <= $this->yBottomLeftCoordinate) {
            throw new InvalidYUpperRightCoordinate;
        }

        $this->occupiedPositions = [];
    }

    public function positionIsValid(Position $position): bool
    {
        $positionX = $position->getX();
        $positionY = $position->getY();

        return $positionX >= $this->xBottomLeftCoordinate &&
            $positionX <= $this->xUpperRightCoordinate &&
            $positionY >= $this->yBottomLeftCoordinate &&
            $positionY <= $this->yUpperRightCoordinate;
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
