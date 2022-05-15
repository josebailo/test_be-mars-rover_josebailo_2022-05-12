<?php

namespace Tests\Unit;

use App\Entities\Plateau;
use PHPUnit\Framework\TestCase;

class PlateauTest extends TestCase
{
    /** @test */
    public function check_if_some_coordinates_are_valid()
    {
        $plateau = new Plateau(5, 5);
        $this->assertTrue($plateau->coordinatesAreValid(1, 2));
        $this->assertTrue($plateau->coordinatesAreValid(0, 0));
        $this->assertTrue($plateau->coordinatesAreValid(5, 5));
        $this->assertFalse($plateau->coordinatesAreValid(6, 3));
        $this->assertFalse($plateau->coordinatesAreValid(-1, 0));
        $this->assertFalse($plateau->coordinatesAreValid(2, 8));
    }
}
