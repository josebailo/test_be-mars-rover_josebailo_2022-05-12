<?php

namespace Tests\Unit;

use App\Entities\PlateauCoordinates;
use App\Exceptions\InvalidXUpperRightCoordinate;
use App\Exceptions\InvalidYUpperRightCoordinate;
use PHPUnit\Framework\TestCase;

class PlateauCoordinatesTest extends TestCase
{
    /** @test */
    public function can_be_created()
    {
        $plateauCoordinates = new PlateauCoordinates(5, 5);
        $this->assertInstanceOf(PlateauCoordinates::class, $plateauCoordinates);
    }

    /** @test */
    public function the_x_upper_right_coordinate_must_be_greater_than_zero()
    {
        $this->expectException(InvalidXUpperRightCoordinate::class);
        $plateauCoordinates = new PlateauCoordinates(0, 1);
    }

    /** @test */
    public function the_y_upper_right_coordinate_must_be_greater_than_zero()
    {
        $this->expectException(InvalidYUpperRightCoordinate::class);
        $plateauCoordinates = new PlateauCoordinates(1, 0);
    }

    /** @test */
    public function returns_the_x_bottom_left_coordinate()
    {
        $plateauCoordinates = new PlateauCoordinates(5, 6);
        $this->assertEquals(0, $plateauCoordinates->getXBottomLeftCoordinate());
    }

    /** @test */
    public function returns_the_y_bottom_left_coordinate()
    {
        $plateauCoordinates = new PlateauCoordinates(5, 6);
        $this->assertEquals(0, $plateauCoordinates->getYBottomLeftCoordinate());
    }

    /** @test */
    public function returns_the_x_upper_right_coordinate()
    {
        $plateauCoordinates = new PlateauCoordinates(5, 6);
        $this->assertEquals(5, $plateauCoordinates->getXUpperRightCoordinate());
    }

    /** @test */
    public function returns_the_y_upper_right_coordinate()
    {
        $plateauCoordinates = new PlateauCoordinates(5, 6);
        $this->assertEquals(6, $plateauCoordinates->getYUpperRightCoordinate());
    }
}
