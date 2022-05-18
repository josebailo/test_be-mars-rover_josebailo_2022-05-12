<?php

namespace App\Services;

use App\Entities\Instructions;
use App\Entities\Plateau;
use App\Entities\Position;
use App\Entities\Rover;
use App\Enums\CardinalPoint;
use App\Enums\Movements;
use Error;

class SimulationService
{
    public function simulate(Instructions $instructions): string
    {
        $plateau = $this->createPlateau($instructions->getPlateauCoordinates());
        $rovers = $this->createRovers($instructions->getRoversInformation());
        $roversMovements = $this->createRoversMovements($instructions->getRoversInformation());

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

        return $this->createRoversSituationOutput($rovers);
    }

    private function createPlateau(array $plateauCoordinates): Plateau
    {
        return new Plateau($plateauCoordinates['x'], $plateauCoordinates['y']);
    }

    private function getRoversPositions($rovers): array
    {
        $positions = [];
        foreach ($rovers as $rover) {
            $positions[] = $rover->getPosition();
        }
        return $positions;
    }

    private function createRoversSituationOutput($rovers): string
    {
        $situations = [];
        foreach ($rovers as $rover) {
            $situations[] = $rover->getSituation();
        }
        return implode("\n", $situations);
    }

    private function createRovers(array $roversInformation): array
    {
        $rovers = [];

        foreach ($roversInformation as $command) {
            $position = new Position($command['position']['x'], $command['position']['y']);
            $heading = CardinalPoint::from($command['heading']);
            $rovers[] = new Rover($position, $heading);
        }

        return $rovers;
    }

    private function createRoversMovements(array $roverCommands): array
    {
        $movements = [];

        foreach ($roverCommands as $command) {
            $movements[] = array_map(
                fn ($movement) => Movements::from($movement),
                $command['movements']
            );
        }

        return $movements;
    }
}
