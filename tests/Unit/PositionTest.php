<?php

namespace Tests\Unit;

use App\Entities\Position;
use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{
    /** @test */
    public function returns_the_x_coordinate()
    {
        $position = new Position(1, 2);
        $this->assertEquals($position->getX(), 1);
        $this->assertNotEquals($position->getX(), 2);
    }

    /** @test */
    public function returns_the_y_coordinate()
    {
        $position = new Position(1, 2);
        $this->assertEquals($position->getY(), 2);
        $this->assertNotEquals($position->getY(), 1);
    }

    /** @test */
    public function check_if_is_the_same_position_as_a_given_position()
    {
        $positionA = new Position(1, 2);
        $positionB = new Position(1, 2);
        $positionC = new Position(1, 3);
        $this->assertTrue($positionA->is($positionB));
        $this->assertFalse($positionA->is($positionC));
    }
}
