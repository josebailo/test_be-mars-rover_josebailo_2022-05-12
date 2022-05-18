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
        $rovers = $this->generateRovers($parseInstructionsService->getRoverCommands());
        $roversMovements = $this->generateRoversMovements($parseInstructionsService->getRoverCommands());

        foreach ($roversMovements as $index => $movements) {
            $rover = $rovers[$index];

            foreach ($movements as $movement) {
                if ($movement->isTurningMovement()) {
                    $movement === Movements::Right ? $rover->turnRight() : $rover->turnLeft();
                } else {
                    $roverForwardPosition = $rover->getForwardPosition();

                    if (!$plateau->coordinatesAreValid($roverForwardPosition->getX(), $roverForwardPosition->getY())) {
                        throw new Error('The next position is out of the plateau. Impossible to move.');
                    }

                    if (in_array($roverForwardPosition, $this->getRoversPositions($rovers))) {
                        throw new Error('The next position is already occupied. Impossible to move.');
                    }

                    $rover->moveForward();
                }
            }
        }

        return $this->generateRoversSituationOutput($rovers);
    }

    private function generatePlateau(array $plateauCoordinatesCommand): Plateau
    {
        return new Plateau($plateauCoordinatesCommand['x'], $plateauCoordinatesCommand['y']);
    }

    private function getRoversPositions($rovers): array
    {
        $positions = [];
        foreach ($rovers as $rover) {
            $positions[] = $rover->getPosition();
        }
        return $positions;
    }

    private function generateRoversSituationOutput($rovers): string
    {
        $situations = [];
        foreach ($rovers as $rover) {
            $situations[] = $rover->getSituation();
        }
        return implode("\n", $situations);
    }

    private function generateRovers(array $roverCommands): array
    {
        $rovers = [];

        foreach ($roverCommands as $command) {
            $position = new Position($command['position']['x'], $command['position']['y']);
            $facing = CardinalPoint::from($command['facing']);
            $rovers[] = new Rover($position, $facing);
        }

        return $rovers;
    }

    private function generateRoversMovements(array $roverCommands): array
    {
        $movements = [];

        foreach ($roverCommands as $command) {
            $movements[] = array_map(
                fn ($movement) => Movements::from($movement),
                $command['movementsList']
            );
        }

        return $movements;
    }
}
