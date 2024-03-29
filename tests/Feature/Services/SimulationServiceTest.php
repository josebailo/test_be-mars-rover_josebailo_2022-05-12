<?php

namespace Tests\Feature\Services;

use App\Entities\Instructions;
use App\Services\ParseInstructionsService;
use App\Services\SimulationService;
use Tests\TestCase;

class SimulationServiceTest extends TestCase
{
    /** @test */
    public function runs_the_simulation_and_returns_the_output()
    {
        $parseInstructionsService = new ParseInstructionsService();
        $instructions = $parseInstructionsService->parse(
            "5 5\n1 2 N\nL M L M L M L M M\n3 3 E\nM M R M M R M R R M"
        );
        $simulationService = new SimulationService();
        $output = $simulationService->simulate($instructions);
        $this->assertEquals($output, "1 3 N\n5 1 E");
    }

    /** @test */
    public function throws_an_error_if_a_rover_cannot_move_because_the_next_position_is_occupied()
    {
        $this->expectError();
        $parseInstructionsService = new ParseInstructionsService();
        $instructions = $parseInstructionsService->parse("5 5\n1 2 N\nM M R M\n2 2 N\nM M M");
        $simulationService = new SimulationService();
        $simulationService->simulate($instructions);
    }

    /** @test */
    public function throws_an_error_if_a_rover_is_going_to_move_out_of_the_plateau()
    {
        $this->expectError();
        $parseInstructionsService = new ParseInstructionsService();
        $instructions = $parseInstructionsService->parse("5 5\n1 2 N\nM M M M M M M M M");
        $simulationService = new SimulationService();
        $simulationService->simulate($instructions);
    }
}
