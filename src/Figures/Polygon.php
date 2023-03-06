<?php

namespace FakeImage\Figures;

use FakeImage\Coordinate;

class Polygon extends Figure
{
    /**
     * @param Coordinate[] $nodes
     *
     * @return Polygon
     */
    public static function withNodes(array $nodes): Polygon
    {
        return (new static())->setNodes($nodes);
    }
}
