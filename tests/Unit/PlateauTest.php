<?php

namespace Tests\Unit;

use App\Entities\Plateau;
use App\Entities\Position;
use PHPUnit\Framework\TestCase;

class PlateauTest extends TestCase
{
    /** @test */
    public function check_if_some_position_are_valid()
    {
        $plateau = new Plateau(5, 5);
        $this->assertTrue($plateau->positionIsValid(new Position(1, 2)));
        $this->assertTrue($plateau->positionIsValid(new Position(0, 0)));
        $this->assertTrue($plateau->positionIsValid(new Position(5, 5)));
        $this->assertFalse($plateau->positionIsValid(new Position(6, 3)));
        $this->assertFalse($plateau->positionIsValid(new Position(-1, 0)));
        $this->assertFalse($plateau->positionIsValid(new Position(2, 8)));
    }

    /** @test */
    public function check_if_some_position_are_occupied()
    {
        $plateau = new Plateau(5, 5);
        $plateau->setOccupiedPositions([
            new Position(1, 2),
            new Position(5, 4),
        ]);
        $this->assertTrue($plateau->positionIsOccupied(new Position(1, 2)));
        $this->assertTrue($plateau->positionIsOccupied(new Position(5, 4)));
        $this->assertFalse($plateau->positionIsOccupied(new Position(1, 3)));
        $this->assertFalse($plateau->positionIsOccupied(new Position(0, 0)));
    }
}
