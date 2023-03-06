<?php

namespace FakeImage;

interface Stackable
{
    public function add(Layerable $layer, ?Coordinate $coordinate = null);

    /**
     * @return resource
     */
    public function toResource();
}
