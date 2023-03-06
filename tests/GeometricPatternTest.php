<?php

use FakeImage\Facades\GeometricPattern;
use PHPUnit\Framework\TestCase;

class GeometricPatternTest extends TestCase
{
    public function testSquarePattern()
    {
        GeometricPattern::withSize(512, 512)
                        ->saveAsFile('./tests/images/square_pattern.png');

        $this->assertFileExists('./tests/images/square_pattern.png');
    }

    public function testHorizontalPattern()
    {
        GeometricPattern::withSize(512, 256)
                        ->saveAsFile('./tests/images/horizontal_pattern.png');

        $this->assertFileExists('./tests/images/horizontal_pattern.png');
    }

    public function testVerticalPattern()
    {
        GeometricPattern::withSize(256, 512)
                        ->saveAsFile('./tests/images/vertical_pattern.png');

        $this->assertFileExists('./tests/images/vertical_pattern.png');
    }

    public function testOneElementPattern()
    {
        GeometricPattern::withSize(256, 256)
                        ->setCount(1)
                        ->saveAsFile('./tests/images/one_element_pattern.png');

        $this->assertFileExists('./tests/images/one_element_pattern.png');
    }
}
