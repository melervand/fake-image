<?php

namespace FakeImage\Figures;

use FakeImage\Coordinate;

class Star extends Figure
{
    /**
     * @param int $size
     * @param int $pointsCount
     * @param int $rotation - in degrees
     *
     * @return Star
     */
    public static function withSize(int $size, int $pointsCount = 5, int $rotation = 0): Star
    {
        $coordinates = [];
        $outerRadius = $size / 2;
        $innerRadius = $outerRadius /
            (\sin(\M_PI / $pointsCount) * (\tan((\M_PI / 2 - \M_PI / $pointsCount)) + \tan(2 * \M_PI / $pointsCount)));

        for ($i = 0; $i <= $pointsCount * 2; $i++) {
            $angle = $i * \M_PI / $pointsCount + \deg2rad($rotation - 90);

            if ($i & 1) {
                $coordinates[] = Coordinate::withXY(
                    $outerRadius + $innerRadius * \cos($angle),
                    $outerRadius + $innerRadius * \sin($angle)
                );
            } else {
                $coordinates[] = Coordinate::withXY(
                    $outerRadius + $outerRadius * \cos($angle),
                    $outerRadius + $outerRadius * \sin($angle)
                );
            }
        }

        return (new static())->setNodes($coordinates);
    }
}
