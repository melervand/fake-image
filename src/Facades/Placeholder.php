<?php

namespace FakeImage\Facades;

use FakeImage\Color;
use FakeImage\Coordinate;
use FakeImage\Figures\Text;
use FakeImage\Image;

class Placeholder extends Image
{
    protected ?Text $text = null;

    /**
     * @param int $width
     * @param int $height
     *
     * @return Placeholder
     */
    public static function withSize(int $width, int $height): Image
    {
        return parent::withSize($width, $height)
                     ->setFillColor(Color::withHEX('ccc'));
    }

    public function setText(string $text, ?Color $color = null, int $fontSize = 5): Placeholder
    {
        $color = $color ?? Color::withRGBA(255, 255, 255);

        $this->text = Text::withString($text, $color, $fontSize);

        return $this;
    }

    public function toResource()
    {
        if (!$this->text) {
            $this->setText("{$this->getWidth()}x{$this->getHeight()}");
        }

        $textWidth = $this->text->getWidth();
        $textHeight = $this->text->getHeight();

        $this->add(
            $this->text,
            Coordinate::withXY(
                ($this->getWidth() - $textWidth) / 2,
                ($this->getHeight() - $textHeight) / 2
            )
        );

        return parent::toResource();
    }
}
