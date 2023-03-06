<?php

namespace FakeImage;

interface Savable
{
    public const TYPE_JPG = 'jpg';
    public const TYPE_PNG = 'png';

    /**
     * @return resource
     */
    public function toResource();

    public function saveAsFile(string $path, int $quality = 90);
}
