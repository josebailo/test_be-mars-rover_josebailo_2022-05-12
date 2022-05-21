<?php

namespace Tests\Feature\Services;

use App\Entities\Instructions;
use App\Exceptions\Instructions\InvalidEmptyInstructions;
use App\Exceptions\Instructions\InvalidMinimumOfLines;
use App\Exceptions\Instructions\InvalidOddAmountOfLines;
use App\Exceptions\Instructions\InvalidPlateauCoordinates;
use App\Exceptions\Instructions\InvalidRoverMovements;
use App\Exceptions\Instructions\InvalidRoverSituation;
use App\Services\ParseInstructionsService;
use Tests\TestCase;

class ParseInstructionsServiceTest extends TestCase
{
    /** @test */
    public function returns_an_instance_of_instructions_entity()
    {
        $parseInstructionsService = new ParseInstructionsService();
        $instructions = $parseInstructionsService->parse("5 7\n1 2 N\nL M L M L M L M M\n3 3 E\nM M R M M R M R R M");
        $this->assertInstanceOf(Instructions::class, $instructions);
    }

    /** @test */
    public function instructions_cannot_be_empty()
    {
        $this->expectException(InvalidEmptyInstructions::class);
        $parseInstructionsService = new ParseInstructionsService();
        $parseInstructionsService->parse('');
    }

    /** @test */
    public function instructions_must_have_an_odd_number_of_lines()
    {
        $this->expectException(InvalidMinimumOfLines::class);
        $parseInstructionsService = new ParseInstructionsService();
        $parseInstructionsService->parse("5 5\n1 2 N");
    }

    /** @test */
    public function instructions_must_have_odd_amount_of_lines()
    {
        $this->expectException(InvalidOddAmountOfLines::class);
        $parseInstructionsService = new ParseInstructionsService();
        $parseInstructionsService->parse("5 5\n1 2 N \nL M L M L M L M M\n3 3 E");
    }

    /** @test */
    public function instructions_must_have_valid_plateau_coordinates()
    {
        $this->expectException(InvalidPlateauCoordinates::class);
        $parseInstructionsService = new ParseInstructionsService();
        $parseInstructionsService->parse("0 5\n1 2 N \nL M L M L M L M M");
    }

    /** @test */
    public function instructions_must_have_valid_situation_for_the_rovers()
    {
        $this->expectException(InvalidRoverSituation::class);
        $parseInstructionsService = new ParseInstructionsService();
        $parseInstructionsService->parse("5 5\n-1 2 N\nM M M");
    }

    /** @test */
    public function instructions_must_have_valid_movements_for_the_rovers()
    {
        $this->expectException(InvalidRoverMovements::class);
        $parseInstructionsService = new ParseInstructionsService();
        $parseInstructionsService->parse("5 5\n1 2 N\nM M Z");
    }
}
