<?php

namespace App\Entities;

use App\Exceptions\InvalidXUpperRightCoordinate;
use App\Exceptions\InvalidYUpperRightCoordinate;

class PlateauCoordinates
{
    public function __construct(
        private int $xUpperRightCoordinate,
        private int $yUpperRightCoordinate,
    ) {
        if ($xUpperRightCoordinate <= 0) {
            throw new InvalidXUpperRightCoordinate;
        }

        if ($yUpperRightCoordinate <= 0) {
            throw new InvalidYUpperRightCoordinate;
        }
    }

    public function getXUpperRightCoordinate(): int
    {
        return $this->xUpperRightCoordinate;
    }

    public function getYUpperRightCoordinate(): int
    {
        return $this->yUpperRightCoordinate;
    }

    public function getXBottomLeftCoordinate(): int
    {
        return 0;
    }

    public function getYBottomLeftCoordinate(): int
    {
        return 0;
    }
}
