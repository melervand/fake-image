<?php

namespace FakeImage;

use FakeImage\Figures\Rectangle;

class Image extends Rectangle implements Layerable, Stackable, Savable
{
    protected array $figures = [];

    /**
     * @param int $width
     * @param int $height
     *
     * @return Image
     */
    public static function withSize(int $width, int $height): Rectangle
    {
        return parent::withSize($width, $height);
    }

    public function add(Layerable $figure, ?Coordinate $coordinate = null): Image
    {
        $this->figures[] = [$figure, $coordinate ?? Coordinate::withXY(0, 0)];

        return $this;
    }

    public function toResource()
    {
        $image = parent::toResource();
        \imagealphablending($image, true);
        \imagesavealpha($image, true);

        foreach ($this->figures as $figure) {
            $layer = $figure[ 0 ];
            $coordinate = $figure[ 1 ];

            $resource = $layer->toResource();

            \imagecopy(
                $image,
                $resource,
                $coordinate->x,
                $coordinate->y,
                0,
                0,
                $layer->getWidth(),
                $layer->getHeight()
            );
        }

        return $image;
    }
}
