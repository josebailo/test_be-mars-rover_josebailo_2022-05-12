<?php

namespace Tests\Feature\Services;

use App\Services\SimulationService;
use Tests\TestCase;

class SimulationServiceTest extends TestCase
{
    /** @test */
    public function runs_the_simulation_and_returns_the_output()
    {
        $instructions = "5 5\n1 2 N\nL M L M L M L M M\n3 3 E\nM M R M M R M R R M";
        $simulationService = new SimulationService();
        $output = $simulationService->simulate($instructions);
        $this->assertEquals($output, "1 3 N\n5 1 E");
    }

    /** @test */
    /** @skip */
    public function throws_an_error_if_a_rover_cannot_move_because_the_next_position_is_occupied()
    {
        $this->expectError();
        $instructions = "5 5\n1 2 N\nM M R M\n2 2 N\nM M M";
        $simulationService = new SimulationService();
        $simulationService->simulate($instructions);
    }
}
