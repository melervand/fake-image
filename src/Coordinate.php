<?php

namespace FakeImage;

class Coordinate
{
    public int $x;
    public int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function withXY(int $x, int $y): Coordinate
    {
        return new static($x, $y);
    }
}
