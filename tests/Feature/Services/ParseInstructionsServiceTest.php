<?php

namespace Tests\Feature\Services;

use App\Services\ParseInstructionsService;
use PHPUnit\Framework\TestCase;

class ParseInstructionsServiceTest extends TestCase
{
    /** @test */
    public function returns_the_plateau_coordinates()
    {
        $parseInstructionsService = new ParseInstructionsService();
        $parseInstructionsService->parse("5 7\n1 2 N \nL M L M L M L M M\n3 3 E\nM M R M M R M R R M");
        $plateauCoordinatesCommand = $parseInstructionsService->getPlateauCoordinatesCommand();
        $this->assertEquals(['x' => 5, 'y' => 7], $plateauCoordinatesCommand);
    }

    /** @test */
    public function returns_the_rovers_commands_by_rover()
    {
        $parseInstructionsService = new ParseInstructionsService();
        $parseInstructionsService->parse("5 7\n1 2 N \nL M L M L M L M M\n3 3 E\nM M R M M R M R R M");

        $roverCommands = $parseInstructionsService->getRoverCommands();
        $this->assertCount(2, $roverCommands);

        $roverACommands = $roverCommands[0];
        $this->assertArrayHasKey('position', $roverACommands);
        $this->assertArrayHasKey('x', $roverACommands['position']);
        $this->assertArrayHasKey('y', $roverACommands['position']);
        $this->assertArrayHasKey('facing', $roverACommands);
        $this->assertArrayHasKey('movementsList', $roverACommands);
    }
}
