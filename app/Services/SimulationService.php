<?php

namespace App\Services;

use App\Entities\Plateau;
use App\Entities\Position;
use App\Entities\Rover;
use App\Enums\CardinalPoint;
use App\Enums\Movements;
use App\Services\ParseInstructionsService;
use Error;

class SimulationService
{
    public function simulate(string $instructions): string
    {
        $parseInstructionsService = new ParseInstructionsService();
        $parseInstructionsService->parse($instructions);

        $plateau = $this->generatePlateau($parseInstructionsService->getPlateauCoordinatesCommand());
        $roversLastPositions = [];

        foreach ($parseInstructionsService->getRoverCommands() as $roverCommands) {
            $rover = $this->generateRover($roverCommands);

            for ($i = 0; $i < count($roverCommands['movementsList']); $i++) {
                $nextPosition = $rover->getNextPosition();

                if ($plateau->positionIsOccupied($nextPosition)) {
                    throw new Error('The next positions is already occupied. Impossible to move.');
                }

                $rover->move();
            }

            $roversLastPositions[] = $rover->getSituation();
        }

        return implode("\n", $roversLastPositions);
    }

    private function generatePlateau(array $plateauCoordinatesCommand): Plateau
    {
        return new Plateau($plateauCoordinatesCommand['x'], $plateauCoordinatesCommand['y']);
    }

    private function generateRover(array $roverCommands): Rover
    {
        $position = new Position($roverCommands['position']['x'], $roverCommands['position']['y']);
        $facing = CardinalPoint::from($roverCommands['facing']);
        $movements = array_map(
            fn ($movement) => Movements::from($movement),
            $roverCommands['movementsList']
        );

        return new Rover($position, $facing, $movements);
    }
}
