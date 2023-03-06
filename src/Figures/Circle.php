<?php

namespace FakeImage\Figures;

use FakeImage\Coordinate;

class Circle extends Figure
{
    /**
     * @param int $size
     * @param int $precision
     * @param int $rotation - in degrees
     *
     * @return Circle
     */
    public static function withSize(int $size, int $precision = 50, int $rotation = 0): Circle
    {
        $coordinates = [];
        $radius = $size / 2;

        for ($i = 0; $i < $precision; $i++) {
            $angle = $i * 2 * \M_PI / $precision + \deg2rad($rotation - 90);

            $coordinates[] = Coordinate::withXY(
                $radius + $radius * \cos($angle),
                $radius + $radius * \sin($angle)
            );
        }

        return (new static())
            ->setNodes($coordinates);
    }
}
