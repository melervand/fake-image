<?php

namespace FakeImage\Figures;

use FakeImage\Color;
use FakeImage\Layerable;

class Text implements Layerable
{
    protected string $string;
    protected int    $fontSize;
    protected Color  $color;

    /**
     * @param string $string
     * @param Color  $color
     * @param int    $fontSize
     *
     * @return Text
     */
    public static function withString(string $string, Color $color, int $fontSize = 5): Text
    {
        return (new static())->setString($string)
                             ->setColor($color)
                             ->setFontSize($fontSize);
    }

    public function setString(string $string): Text
    {
        $this->string = $string;

        return $this;
    }

    public function setColor(Color $color): Text
    {
        $this->color = $color;

        return $this;
    }

    public function setFontSize(int $fontSize): Text
    {
        $this->fontSize = $fontSize;

        return $this;
    }

    public function getWidth(): int
    {
        $fontWidth = \imagefontwidth($this->fontSize);
        $stringLength = \strlen($this->string);

        return $stringLength * $fontWidth;
    }

    public function getHeight(): int
    {
        return \imagefontheight($this->fontSize);
    }

    public function toResource()
    {
        $image = imagecreatetruecolor(
            $this->getWidth(),
            $this->getHeight()
        );
        imagealphablending($image, false);
        imagesavealpha($image, true);

        //transparent background
        \imagefilledrectangle(
            $image,
            0,
            0,
            $this->getWidth(),
            $this->getHeight(),
            Color::withRGBA(255, 255, 255, 0)->toColor($image)
        );

        imagestring(
            $image,
            $this->fontSize,
            0,
            0,
            $this->string,
            $this->color->toColor($image)
        );

        return $image;
    }
}
