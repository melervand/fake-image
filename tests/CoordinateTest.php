<?php

use FakeImage\Coordinate;
use PHPUnit\Framework\TestCase;

class CoordinateTest extends TestCase
{
    public function testCoordinate()
    {
        $coordinate = Coordinate::withXY(128, 256);

        $this->assertEquals(128, $coordinate->x);
        $this->assertEquals(256, $coordinate->y);
    }
}
