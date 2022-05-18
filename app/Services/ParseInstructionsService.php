<?php

namespace App\Services;

class ParseInstructionsService
{
    private array $plateauCoordinatesCommand;
    private array $roverCommands;

    public function parse(string $instructions): void
    {
        $commands = explode("\n", $instructions);
        $plateauCoordinatesCommand = $commands[0];
        $roverCommands = array_slice($commands, 1);

        $this->parsePlateauCoordinatesCommand($plateauCoordinatesCommand);
        $this->parseRoverCommands($roverCommands);
    }

    public function getPlateauCoordinatesCommand(): array
    {
        return $this->plateauCoordinatesCommand;
    }

    public function getRoverCommands(): array
    {
        return $this->roverCommands;
    }

    private function parsePlateauCoordinatesCommand(string $command): void
    {
        list($x, $y) = explode(' ', $command);

        $this->plateauCoordinatesCommand = [
            'x' => $x,
            'y' => $y,
        ];
    }

    private function parseRoverCommands(array $commands): void
    {
        $commandsByRover = array_chunk($commands, 2);
        $this->roverCommands = array_map(function ($rover) {
            list($xCoordinate, $yCoordinate, $facing) = explode(' ', $rover[0]);
            $movementsList = explode(' ', $rover[1]);
            return [
                'position' => [
                    'x' => $xCoordinate,
                    'y' => $yCoordinate
                ],
                'facing' => $facing,
                'movementsList' => $movementsList,
            ];
        }, $commandsByRover);
    }
}
