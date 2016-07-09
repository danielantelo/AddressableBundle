<?php

namespace Addressable\Bundle\Model;

interface GeoPointInterface
{
    /**
     * Returns the latitude of the address.
     *
     * @return float
     */
    public function getLatitude();

    /**
     * Returns the latitude of the address.
     *
     * @return float
     */
    public function getLongitude();
}
