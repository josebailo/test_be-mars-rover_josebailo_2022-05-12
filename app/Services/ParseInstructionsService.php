<?php

namespace App\Services;

use App\Entities\Instructions;

class ParseInstructionsService
{
    public function parse(string $instructions): Instructions
    {
        [$plateauInstruction, $roversInstructions] = $this->splitInstructions($instructions);

        $plateauCoordinates = $this->parsePlateauInstruction($plateauInstruction);
        $roversInformation = $this->parseRoversInstructions($roversInstructions);

        return new Instructions($plateauCoordinates, $roversInformation);
    }

    private function splitInstructions(string $instructions): array
    {
        $instructionsLines = explode("\n", $instructions);
        $plateauInstruction = $instructionsLines[0];
        $roversInstructions = array_slice($instructionsLines, 1);

        return [$plateauInstruction, $roversInstructions];
    }

    private function parsePlateauInstruction(string $instruction): array
    {
        [$x, $y] = explode(' ', $instruction);

        return [
            'x' => $x,
            'y' => $y,
        ];
    }

    private function parseRoversInstructions(array $instructions): array
    {
        $instructionsByRover = array_chunk($instructions, 2);

        return array_map(function ($roverInstructions) {
            [$situation, $movementsList] = $roverInstructions;
            [$xCoordinate, $yCoordinate, $heading] = explode(' ', $situation);
            $movements = explode(' ', $movementsList);

            return [
                'position' => [
                    'x' => $xCoordinate,
                    'y' => $yCoordinate
                ],
                'heading' => $heading,
                'movements' => $movements,
            ];
        }, $instructionsByRover);
    }
}
