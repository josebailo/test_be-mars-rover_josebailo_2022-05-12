<?php

namespace App\Services;

use App\Entities\Instructions;
use App\Enums\Heading;
use App\Enums\Movement;
use App\Exceptions\Instructions\InvalidEmptyInstructions;
use App\Exceptions\Instructions\InvalidMinimumOfLines;
use App\Exceptions\Instructions\InvalidOddAmountOfLines;
use App\Exceptions\Instructions\InvalidPlateauCoordinates;
use App\Exceptions\Instructions\InvalidRoverMovements;
use App\Exceptions\Instructions\InvalidRoverSituation;

class ParseInstructionsService
{
    public function parse(string $instructions): Instructions
    {
        $this->validate($instructions);

        [$plateauInstruction, $roversInstructions] = $this->splitInstructions($instructions);

        $plateauCoordinates = $this->parsePlateauInstruction($plateauInstruction);
        $roversInformation = $this->parseRoversInstructions($roversInstructions);

        return new Instructions($plateauCoordinates, $roversInformation);
    }

    public static function validate(string $instructions): void
    {
        self::validateIsNotEmpty($instructions);

        $instructionsLines = preg_split('/\n\r|\r\n|\n|\r/', $instructions);
        self::validateMinimumOfLines($instructionsLines);
        self::validateOddAmountOfLines($instructionsLines);

        [$plateauInstruction, $roversInstructions] = self::splitInstructions($instructions);
        self::validatePlateauCoordinates($plateauInstruction);

        $instructionsByRover = array_chunk($roversInstructions, 2);
        foreach ($instructionsByRover as $roverInstructions) {
            [$situation, $movements] = $roverInstructions;
            self::validateRoverSituationInstruction($situation);
            self::validateRoverMovementsInstruction($movements);
        }
    }

    private static function validateIsNotEmpty(string $value): void
    {
        if ($value === '') {
            throw new InvalidEmptyInstructions;
        }
    }

    private static function validateMinimumOfLines(array $lines): void
    {
        if (count($lines) < 3) {
            throw new InvalidMinimumOfLines;
        }
    }

    private static function validateOddAmountOfLines(array $lines): void
    {
        if (count($lines) % 2 === 0) {
            throw new InvalidOddAmountOfLines;
        }
    }

    private static function validatePlateauCoordinates(string $value): void
    {
        if (!preg_match('/^[1-9][0-9]* [1-9][0-9]*$/', $value)) {
            throw new InvalidPlateauCoordinates;
        }
    }

    private static function validateRoverSituationInstruction(string $value): void
    {
        $headings = array_map(fn ($heading) => $heading->value, Heading::cases());
        $headingsRegexRule = '(' . implode('|', $headings) . ')';
        $regex = "/^([0-9]|[1-9][0-9]*) ([0-9]|[1-9][0-9]*) $headingsRegexRule$/";

        if (!preg_match($regex, $value)) {
            throw new InvalidRoverSituation;
        }
    }

    private static function validateRoverMovementsInstruction(string $value): void
    {
        $movements = array_map(fn ($movement) => $movement->value, Movement::cases());
        $movementsRegexRule = '(' . implode('|', $movements) . ')';
        $regex = "/^$movementsRegexRule( $movementsRegexRule)*$/";

        if (!preg_match($regex, $value)) {
            throw new InvalidRoverMovements;
        }
    }

    private static function splitInstructions(string $instructions): array
    {
        $instructionsLines = preg_split('/\n\r|\r\n|\n|\r/', $instructions);
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
