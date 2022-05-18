<?php

namespace App\Entities;

use App\Exceptions\InvalidXUpperRightCoordinate;
use App\Exceptions\InvalidYUpperRightCoordinate;

class Plateau
{
    private int $xBottomLeftCoordinate = 0;
    private int $yBottomLeftCoordinate = 0;

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

    public function coordinatesAreValid(int $x, int $y): bool
    {
        return $x >= $this->xBottomLeftCoordinate &&
            $x <= $this->xUpperRightCoordinate &&
            $y >= $this->yBottomLeftCoordinate &&
            $y <= $this->yUpperRightCoordinate;
    }
}
