<?php

namespace App\Enums;

enum Heading: string
{
    case North = 'N';
    case South = 'S';
    case East = 'E';
    case West = 'W';

    public function nextPointTurningRight(): static
    {
        return match ($this) {
            self::North => self::East,
            self::East => self::South,
            self::South => self::West,
            self::West => self::North,
        };
    }

    public function nextPointTurningLeft(): static
    {
        return match ($this) {
            self::North => self::West,
            self::West => self::South,
            self::South => self::East,
            self::East => self::North,
        };
    }
}
