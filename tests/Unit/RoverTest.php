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
    public function returns_his_situation()
    {
        $rover = new Rover(new Position(1, 2), CardinalPoint::North);
        $this->assertEquals($rover->getSituation(), '1 2 N');
        $rover = new Rover(new Position(3, 5), CardinalPoint::East);
        $this->assertEquals($rover->getSituation(), '3 5 E');
    }

    /** @test */
    public function returns_his_next_position()
    {
        $rover = new Rover(new Position(1, 2), CardinalPoint::North, [Movements::Move]);
        $this->assertEquals($rover->getNextPosition(), new Position(1, 3));
        $rover = new Rover(new Position(1, 2), CardinalPoint::South, [Movements::Move]);
        $this->assertEquals($rover->getNextPosition(), new Position(1, 1));
        $rover = new Rover(new Position(1, 2), CardinalPoint::East, [Movements::Move]);
        $this->assertEquals($rover->getNextPosition(), new Position(2, 2));
        $rover = new Rover(new Position(1, 2), CardinalPoint::West, [Movements::Move]);
        $this->assertEquals($rover->getNextPosition(), new Position(0, 2));
    }

    /** @test */
    public function move_to_his_next_position()
    {
        $rover = new Rover(new Position(1, 2), CardinalPoint::North, [
            Movements::Move,
            Movements::Right,
            Movements::Move,
            Movements::Left,
            Movements::Left,
            Movements::Move,
            Movements::Move,
            Movements::Left,
            Movements::Move,
            Movements::Move,
            Movements::Left,
            Movements::Move,
        ]);
        $rover->move();
        $this->assertEquals($rover->getSituation(), '1 3 N');
        $rover->move();
        $this->assertEquals($rover->getSituation(), '1 3 E');
        $rover->move();
        $this->assertEquals($rover->getSituation(), '2 3 E');
        $rover->move();
        $this->assertEquals($rover->getSituation(), '2 3 N');
        $rover->move();
        $this->assertEquals($rover->getSituation(), '2 3 W');
        $rover->move();
        $this->assertEquals($rover->getSituation(), '1 3 W');
        $rover->move();
        $this->assertEquals($rover->getSituation(), '0 3 W');
        $rover->move();
        $this->assertEquals($rover->getSituation(), '0 3 S');
        $rover->move();
        $this->assertEquals($rover->getSituation(), '0 2 S');
        $rover->move();
        $this->assertEquals($rover->getSituation(), '0 1 S');
        $rover->move();
        $this->assertEquals($rover->getSituation(), '0 1 E');
        $rover->move();
        $this->assertEquals($rover->getSituation(), '1 1 E');
    }
}
