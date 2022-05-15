<?php

namespace Tests\Unit;

use App\Entities\Rover;
use App\Enums\CardinalPoint;
use PHPUnit\Framework\TestCase;

class RoverTest extends TestCase
{
    /** @test */
    public function rover_can_return_his_position()
    {
        $rover = new Rover(1, 2, CardinalPoint::North);
        $this->assertEquals($rover->getPosition(), '1 2 N');
        $rover = new Rover(3, 5, CardinalPoint::East);
        $this->assertEquals($rover->getPosition(), '3 5 E');
    }
}
