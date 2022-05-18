<?php

namespace Tests\Unit;

use App\Entities\Instructions;
use PHPUnit\Framework\TestCase;

class InstructionsTest extends TestCase
{
    private Instructions $instructions;

    public function setUp(): void
    {
        $this->instructions = new Instructions(
            ['x' => 5, 'y' => 7],
            [
                [
                    'position' => ['x' => 1, 'y' => 2],
                    'heading' => 'N',
                    'movements' => ['L', 'M', 'L', 'M', 'L', 'M', 'L', 'M', 'M'],
                ],
                [
                    'position' => ['x' => 3, 'y' => 3],
                    'heading' => 'E',
                    'movements' => ['M', 'M', 'R', 'M', 'M', 'R', 'M', 'R', 'R', 'M'],
                ],
            ],
        );
    }

    /** @test */
    public function returns_the_plateau_coordinates()
    {
        $this->assertEquals(['x' => 5, 'y' => 7], $this->instructions->getPlateauCoordinates());
    }

    /** @test */
    public function returns_the_rovers_commands_by_rover()
    {
        $roversInformation = $this->instructions->getRoversInformation();
        $this->assertCount(2, $roversInformation);

        $roverAInformation = $roversInformation[0];
        $this->assertEquals([
            'position' => ['x' => 1, 'y' => 2],
            'heading' => 'N',
            'movements' => ['L', 'M', 'L', 'M', 'L', 'M', 'L', 'M', 'M'],
        ], $roverAInformation);
    }
}
