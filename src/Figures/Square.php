<?php

namespace FakeImage\Figures;

use FakeImage\Coordinate;

class Square extends Figure
{
    /**
     * @param int $size
     *
     * @return Square
     */
    public static function withSize(int $size): Square
    {
        return (new static())->setNodes(
            [
                Coordinate::withXY(0, 0),
                Coordinate::withXY($size, 0),
                Coordinate::withXY($size, $size),
                Coordinate::withXY(0, $size),
            ]
        );
    }
}
