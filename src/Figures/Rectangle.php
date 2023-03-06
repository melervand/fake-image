<?php

namespace FakeImage\Figures;

use FakeImage\Coordinate;

class Rectangle extends Figure
{
    /**
     * @param int $width
     * @param int $height
     *
     * @return Rectangle
     */
    public static function withSize(int $width, int $height): Rectangle
    {
        return (new static())->setNodes(
            [
                Coordinate::withXY(0, 0),
                Coordinate::withXY($width, 0),
                Coordinate::withXY($width, $height),
                Coordinate::withXY(0, $height),
            ]
        );
    }
}
