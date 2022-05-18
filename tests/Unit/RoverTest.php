<?php

namespace Tests\Unit;

use App\Entities\Position;
use App\Entities\Rover;
use App\Enums\CardinalPoint;
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
    public function returns_his_position()
    {
        $position = new Position(1, 2);
        $rover = new Rover($position, CardinalPoint::North);
        $this->assertEquals($position, $rover->getPosition());

        $position = new Position(3, 5);
        $rover = new Rover(new Position(3, 5), CardinalPoint::East);
        $this->assertEquals($position, $rover->getPosition());
    }

    /** @test */
    public function returns_his_forward_position()
    {
        $rover = new Rover(new Position(1, 2), CardinalPoint::North);
        $this->assertEquals($rover->getForwardPosition(), new Position(1, 3));

        $rover = new Rover(new Position(1, 2), CardinalPoint::East);
        $this->assertEquals($rover->getForwardPosition(), new Position(2, 2));

        $rover = new Rover(new Position(1, 2), CardinalPoint::South);
        $this->assertEquals($rover->getForwardPosition(), new Position(1, 1));

        $rover = new Rover(new Position(1, 2), CardinalPoint::West);
        $this->assertEquals($rover->getForwardPosition(), new Position(0, 2));
    }

    /** @test */
    public function updates_his_position_by_moving_forward()
    {
        $rover = new Rover(new Position(1, 2), CardinalPoint::North);
        $this->assertEquals($rover->getSituation(), '1 2 N');
        $rover->moveForward();
        $this->assertEquals($rover->getSituation(), '1 3 N');
        $rover->moveForward();
        $this->assertEquals($rover->getSituation(), '1 4 N');
    }

    /** @test */
    public function updates_his_heading_by_turning_to_left()
    {
        $rover = new Rover(new Position(1, 2), CardinalPoint::North);
        $this->assertEquals($rover->getSituation(), '1 2 N');
        $rover->turnLeft();
        $this->assertEquals($rover->getSituation(), '1 2 W');
        $rover->turnLeft();
        $this->assertEquals($rover->getSituation(), '1 2 S');
        $rover->turnLeft();
        $this->assertEquals($rover->getSituation(), '1 2 E');
        $rover->turnLeft();
        $this->assertEquals($rover->getSituation(), '1 2 N');
    }

    /** @test */
    public function updates_his_heading_by_turning_to_right()
    {
        $rover = new Rover(new Position(1, 2), CardinalPoint::North);
        $this->assertEquals($rover->getSituation(), '1 2 N');
        $rover->turnRight();
        $this->assertEquals($rover->getSituation(), '1 2 E');
        $rover->turnRight();
        $this->assertEquals($rover->getSituation(), '1 2 S');
        $rover->turnRight();
        $this->assertEquals($rover->getSituation(), '1 2 W');
        $rover->turnRight();
        $this->assertEquals($rover->getSituation(), '1 2 N');
    }
}
