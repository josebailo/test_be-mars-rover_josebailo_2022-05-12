<?php

namespace App\Entities;

class Instructions
{
    public function __construct(
        private array $plateauCoordinates,
        private array $roversInformation,
    )
    { }

    public function getPlateauCoordinates(): array
    {
        return $this->plateauCoordinates;
    }

    public function getRoversInformation(): array
    {
        return $this->roversInformation;
    }
}
