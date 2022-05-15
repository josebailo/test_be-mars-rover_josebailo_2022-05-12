<?php

namespace Tests\Unit;

use App\Entities\Position;
use App\Entities\Rover;
use App\Enums\CardinalPoint;
use App\Enums\Movements;
use PHPUnit\Framework\TestCase;

class RoverTest extends TestCase
{
    /** @test */
    public function returns_his_status()
    {
        $rover = new Rover(new Position(1, 2), CardinalPoint::North);
        $this->assertEquals($rover->getStatus(), '1 2 N');
        $rover = new Rover(new Position(3, 5), CardinalPoint::East);
        $this->assertEquals($rover->getStatus(), '3 5 E');
    }

    /** @test */
    public function returns_his_next_position()
    {
        $rover = new Rover(new Position(1, 2), CardinalPoint::North, [Movements::Move]);
        $this->assertEquals($rover->getNextPosition(), new Position(2, 2));
        $rover = new Rover(new Position(1, 2), CardinalPoint::South, [Movements::Move]);
        $this->assertEquals($rover->getNextPosition(), new Position(0, 2));
        $rover = new Rover(new Position(1, 2), CardinalPoint::East, [Movements::Move]);
        $this->assertEquals($rover->getNextPosition(), new Position(1, 3));
        $rover = new Rover(new Position(1, 2), CardinalPoint::West, [Movements::Move]);
        $this->assertEquals($rover->getNextPosition(), new Position(1, 1));
    }
}
