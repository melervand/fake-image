<?php

namespace FakeImage\Figures;

use FakeImage\Color;
use FakeImage\Coordinate;
use FakeImage\Layerable;
use FakeImage\Savable;

abstract class Figure implements Layerable, Savable
{
    protected array $nodes;
    protected Color $strokeColor;
    protected Color $fillColor;

    public function __construct()
    {
        $this->nodes = [];
        $this->strokeColor = Color::withHEX('fff', 0);
        $this->fillColor = Color::withHEX('fff', 0);
    }

    /**
     * @param Coordinate[] $nodes
     *
     * @return Layerable
     */
    protected function setNodes(array $nodes): Figure
    {
        $this->nodes = $nodes;

        return $this;
    }

    public function setStrokeColor(Color $color): Figure
    {
        $this->strokeColor = $color;

        return $this;
    }

    public function getStrokeColor(): Color
    {
        return $this->strokeColor;
    }

    public function setFillColor(Color $color): Figure
    {
        $this->fillColor = $color;

        return $this;
    }

    public function getFillColor(): Color
    {
        return $this->fillColor;
    }

    public function getWidth(): int
    {
        //rightmost point x + left margin
        return max(array_map(fn(Coordinate $c) => $c->x, $this->nodes)) +
            \min(\array_map(fn(Coordinate $c) => $c->x, $this->nodes));
    }

    public function getHeight(): int
    {
        //lowest point y + top margin
        return max(array_map(fn(Coordinate $c) => $c->y, $this->nodes)) +
            \min(\array_map(fn(Coordinate $c) => $c->y, $this->nodes));
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

        imagefilledpolygon(
            $image,
            array_reduce(
                $this->nodes,
                function ($result, Coordinate $coordinate) {
                    $result[] = $coordinate->x;
                    $result[] = $coordinate->y;

                    return $result;
                },
                []
            ),
            count($this->nodes),
            $this->fillColor->toColor($image)
        );

        if ($this->strokeColor->getAlpha() > 0) {
            imagepolygon(
                $image,
                array_reduce(
                    $this->nodes,
                    function ($result, Coordinate $coordinate) {
                        $result[] = $coordinate->x === $this->getWidth() ? $coordinate->x - 1 : $coordinate->x;
                        $result[] = $coordinate->y === $this->getHeight() ? $coordinate->y - 1 : $coordinate->y;

                        return $result;
                    },
                    []
                ),
                count($this->nodes),
                $this->strokeColor->toColor($image)
            );
        }

        return $image;
    }

    /**
     * @param string $path
     * @param int    $quality
     *
     * @return string
     * @throws \Exception
     */
    public function saveAsFile(string $path, int $quality = 90): string
    {
        $image = $this->toResource();

        $path = \str_replace(['\\', '/'], \DIRECTORY_SEPARATOR, $path);
        $hasFilename = \substr($path, -1) !== \DIRECTORY_SEPARATOR;

        $pathInfo = pathinfo($path);

        $pathInfo = [
            'dirname'   => $hasFilename
                ? $pathInfo[ 'dirname' ]
                : \rtrim($path, '\\/'),
            'filename'  => $hasFilename
                ? $pathInfo[ 'filename' ]
                : bin2hex(random_bytes(16)),
            'extension' => $pathInfo[ 'extension' ] ?? self::TYPE_PNG,
        ];

        $path = $pathInfo[ 'dirname' ] . DIRECTORY_SEPARATOR . $pathInfo[ 'filename' ] . '.' . $pathInfo[ 'extension' ];

        switch ($pathInfo[ 'extension' ]) {
            case self::TYPE_JPG:
                imagejpeg($image, $path, $quality);
                break;
            case self::TYPE_PNG:
            default:
                imagepng($image, $path);
        }

        return $path;
    }
}
