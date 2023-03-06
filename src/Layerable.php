<?php

namespace FakeImage;

interface Layerable
{
    public function getWidth(): int;

    public function getHeight(): int;

    /**
     * @return resource
     */
    public function toResource();
}
