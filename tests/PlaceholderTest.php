<?php

use FakeImage\Color;
use FakeImage\Facades\Placeholder;
use PHPUnit\Framework\TestCase;

class PlaceholderTest extends TestCase
{
    public function testPlaceholder()
    {
        Placeholder::withSize(256, 128)
                   ->setFillColor(Color::withHEX('ccc'))
                   ->saveAsFile('./tests/images/placeholder.png');

        $this->assertFileExists('./tests/images/placeholder.png');
    }
}
