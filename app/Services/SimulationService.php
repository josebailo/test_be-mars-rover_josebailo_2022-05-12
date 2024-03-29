<?php

namespace App\Services;

use App\Entities\Instructions;
use App\Entities\Plateau;
use App\Entities\Position;
use App\Entities\Rover;
use App\Enums\Heading;
use App\Enums\Movement;
use Error;

class SimulationService
{
    private Plateau $plateau;
    private array $rovers;
    private array $roversMovements;

    public function simulate(Instructions $instructions): string
    {
        $roversInformation = $instructions->getRoversInformation();
        $this->plateau = $this->createPlateau($instructions->getPlateauCoordinates());
        $this->rovers = $this->createRovers($roversInformation);
        $this->roversMovements = $this->createRoversMovements($roversInformation);
        $this->runMovements();

        return $this->createRoversSituationOutput();
    }

    private function createPlateau(array $plateauCoordinates): Plateau
    {
        return new Plateau($plateauCoordinates['x'], $plateauCoordinates['y']);
    }

    private function positionIsOccupied($position): bool
    {
        foreach ($this->rovers as $rover) {
            if ($rover->getPosition()->is($position)) {
                return true;
            }
        }

        return false;
    }

    private function createRoversSituationOutput(): string
    {
        $situations = [];
        foreach ($this->rovers as $rover) {
            $situations[] = $rover->getSituation();
        }
        return implode(PHP_EOL, $situations);
    }

    private function createRovers(array $roversInformation): array
    {
        $rovers = [];

        foreach ($roversInformation as $command) {
            $position = new Position($command['position']['x'], $command['position']['y']);
            $heading = Heading::from($command['heading']);
            $rovers[] = new Rover($position, $heading);
        }

        return $rovers;
    }

    private function createRoversMovements(array $roverCommands): array
    {
        $movements = [];

        foreach ($roverCommands as $command) {
            $movements[] = array_map(
                fn ($movement) => Movement::from($movement),
                $command['movements']
            );
        }

        return $movements;
    }

    private function runMovements(): void
    {
        foreach ($this->roversMovements as $index => $movements) {
            $rover = $this->rovers[$index];

            foreach ($movements as $movement) {
                if ($movement->isTurningMovement()) {
                    $movement === Movement::Right ? $rover->turnRight() : $rover->turnLeft();
                    continue;
                }

                $roverForwardPosition = $rover->getForwardPosition();

                if (
                    !$this->plateau->coordinatesAreValid($roverForwardPosition->getX(), $roverForwardPosition->getY())
                ) {
                    throw new Error('The next position is out of the plateau. Impossible to move.');
                }

                if ($this->positionIsOccupied($roverForwardPosition)) {
                    throw new Error('The next position is already occupied. Impossible to move.');
                }

                $rover->moveForward();
            }
        }
    }
}
