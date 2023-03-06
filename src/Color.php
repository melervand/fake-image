<?php

namespace FakeImage;

class Color
{
    protected int   $r;
    protected int   $g;
    protected int   $b;
    protected float $alpha;

    public static function withRGBA(int $r, int $g, int $b, float $alpha = 1): Color
    {
        $color = new static();
        $color->r = $r;
        $color->g = $g;
        $color->b = $b;
        $color->alpha = $alpha;

        return $color;
    }

    public static function withHEX(string $hex, float $alpha = 1): Color
    {
        $hex = str_split(trim($hex, '#'));
        $length = count($hex);

        if (!in_array($length, [3, 6])) {
            throw new \InvalidArgumentException('Invalid HEX value!');
        }

        $hex = $length === 3 ? "$hex[0]$hex[0]$hex[1]$hex[1]$hex[2]$hex[2]" : $hex;

        $color = new static();
        $color->r = hexdec("$hex[0]$hex[1]");
        $color->g = hexdec("$hex[2]$hex[3]");
        $color->b = hexdec("$hex[4]$hex[5]");
        $color->alpha = $alpha;

        return $color;
    }

    public static function random(): Color
    {
        $r = round(((float)rand() / (float)getrandmax()) * 127) + 127;
        $g = round(((float)rand() / (float)getrandmax()) * 127) + 127;
        $b = round(((float)rand() / (float)getrandmax()) * 127) + 127;

        return static::withRGBA($r, $g, $b);
    }

    public function getR(): int
    {
        return $this->r;
    }

    public function getG(): int
    {
        return $this->g;
    }

    public function getB(): int
    {
        return $this->b;
    }

    public function getAlpha(): float
    {
        return $this->alpha;
    }

    public function toRGB(): array
    {
        return [
            $this->r,
            $this->g,
            $this->b,
        ];
    }

    public function toRGBA(): array
    {
        return [
            $this->r,
            $this->g,
            $this->b,
            $this->alpha,
        ];
    }

    public function toHEX(): string
    {
        return \implode(
            '',
            [
                '#',
                \str_pad(\dechex($this->r), 2, '0'),
                \str_pad(\dechex($this->g), 2, '0'),
                \str_pad(\dechex($this->b), 2, '0'),
            ]
        );
    }

    public function toColor($image)
    {
        return imagecolorallocatealpha(
            $image,
            $this->r,
            $this->g,
            $this->b,
            \abs(($this->alpha * 127 - 127) * -1)
        );
    }
}
