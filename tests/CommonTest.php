<?php

use FakeImage\Color;
use FakeImage\Figures\Text;
use FakeImage\Image;
use PHPUnit\Framework\TestCase;

class CommonTest extends TestCase
{
    public function testSize()
    {
        $image = Image::withSize(256, 128);

        $this->assertEquals(256, $image->getWidth());
        $this->assertEquals(128, $image->getHeight());
    }

    public function testFillColor()
    {
        $image = Image::withSize(256, 256)
                      ->setFillColor(Color::withHEX('ff0000'));

        $color = $image->getFillColor();

        $this->assertEquals('#ff0000', $color->toHEX());
        $this->assertEquals('1', $color->getAlpha());
    }

    public function testStrokeColor()
    {
        $image = Image::withSize(256, 256)
                      ->setStrokeColor(Color::withHEX('ff0000'));

        $color = $image->getStrokeColor();

        $this->assertEquals('#ff0000', $color->toHEX());
        $this->assertEquals('1', $color->getAlpha());
    }

    public function testLayers()
    {
        Image::withSize(256, 256)
             ->setFillColor(Color::withHEX('ccc'))
             ->add(Text::withString('256x256', Color::withHEX('000')))
             ->saveAsFile('./tests/images/image.png');

        $this->assertFileExists('./tests/images/image.png');
    }
}
