<?php

namespace FakeImage\Facades;

use FakeImage\Color;
use FakeImage\Coordinate;
use FakeImage\Figures\Circle;
use FakeImage\Figures\Rectangle;
use FakeImage\Figures\Square;
use FakeImage\Image;

class GeometricPattern extends Image
{
    protected int $count  = 2;
    protected int $gap    = 3;
    protected int $margin = 10;

    /**
     * @param int $width
     * @param int $height
     *
     * @return GeometricPattern
     */
    public static function withSize(int $width, int $height): Rectangle
    {
        return parent::withSize($width, $height);
    }

    public function setCount(int $count): GeometricPattern
    {
        $this->count = $count;

        return $this;
    }

    public function setGap(int $gap): GeometricPattern
    {
        $this->gap = $gap;

        return $this;
    }

    public function setMargin(int $margin): GeometricPattern
    {
        $this->margin = $margin;

        return $this;
    }

    public function toResource()
    {
        $width = \min($this->getWidth(), $this->getHeight());

        $elementWidth = ($width - $this->margin * 2 - $this->gap * ($this->count - 1)) / $this->count;
        $xCount = \floor(($this->getWidth() - $this->margin * 2) / $elementWidth);
        $yCount = \floor(($this->getHeight() - $this->margin * 2) / $elementWidth);

        $leftMargin = ($this->getWidth() - $elementWidth * $xCount) / 2;
        $topMargin = ($this->getHeight() - $elementWidth * $yCount) / 2;

        $randomElements = [
            Circle::withSize($elementWidth, 100)->setFillColor(Color::random()),
            Circle::withSize($elementWidth, 100)->setFillColor(Color::random()),
            Square::withSize($elementWidth)->setFillColor(Color::random()),
            Image::withSize($elementWidth, $elementWidth)
                 ->add(Circle::withSize($elementWidth)->setFillColor($color = Color::random()))
                 ->add(Rectangle::withSize($elementWidth / 2, $elementWidth / 2)->setFillColor($color)),
            Image::withSize($elementWidth, $elementWidth)
                 ->add(Circle::withSize($elementWidth)->setFillColor($color = Color::random()))
                 ->add(
                     Rectangle::withSize($elementWidth / 2, $elementWidth / 2)->setFillColor($color),
                     Coordinate::withXY($elementWidth / 2, 0)
                 ),
            Image::withSize($elementWidth, $elementWidth)
                 ->add(Circle::withSize($elementWidth)->setFillColor($color = Color::random()))
                 ->add(
                     Rectangle::withSize($elementWidth / 2, $elementWidth / 2)->setFillColor($color),
                     Coordinate::withXY(0, $elementWidth / 2)
                 ),
        ];

        for ($x = 0; $x < $xCount; $x++) {
            for ($y = 0; $y < $yCount; $y++) {
                \shuffle($randomElements);

                $this->add(
                    $randomElements[ 0 ],
                    Coordinate::withXY(
                        $leftMargin + $x * $this->gap + $x * $elementWidth,
                        $topMargin + $y * $this->gap + $y * $elementWidth
                    )
                );
            }
        }

        return parent::toResource();
    }
}
