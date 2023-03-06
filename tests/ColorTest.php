<?php

use FakeImage\Color;
use PHPUnit\Framework\TestCase;

class ColorTest extends TestCase
{
    public function testShorthandHex2Rgb()
    {
        $color = Color::withHEX('#ccc', 1);
        $rgba = $color->toRGBA();

        $this->assertEquals('204', $rgba[ 0 ]);
        $this->assertEquals('204', $rgba[ 1 ]);
        $this->assertEquals('204', $rgba[ 2 ]);
        $this->assertEquals('1', $rgba[ 3 ]);
    }

    public function testHex2Rgb()
    {
        $color = Color::withHEX('#cccccc', 1);
        $rgba = $color->toRGBA();

        $this->assertEquals('204', $rgba[ 0 ]);
        $this->assertEquals('204', $rgba[ 1 ]);
        $this->assertEquals('204', $rgba[ 2 ]);
        $this->assertEquals('1', $rgba[ 3 ]);
    }

    public function testBlackHex2Rgb()
    {
        $color = Color::withHEX('000');
        $rgba = $color->toRGBA();

        $this->assertEquals(0, $rgba[ 0 ]);
        $this->assertEquals(0, $rgba[ 1 ]);
        $this->assertEquals(0, $rgba[ 2 ]);
        $this->assertEquals('1', $rgba[ 3 ]);
    }

    public function testRgb2Hex()
    {
        $color = Color::withRGBA(204, 204, 204);

        $this->assertEquals('#cccccc', $color->toHEX());
        $this->assertEquals('1', $color->getAlpha());
    }
}
