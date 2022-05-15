<?php

namespace App\Entities;

class Plateau
{
    public function __construct(
        private int $xUpperRightCoordinate,
        private int $yUpperRightCoordinate,
    ) { }

    public function coordinatesAreValid(int $x, int $y): bool
    {
        return $x >= 0 && $x <= $this->xUpperRightCoordinate &&
            $y >= 0 && $y <= $this->yUpperRightCoordinate;
    }
}
