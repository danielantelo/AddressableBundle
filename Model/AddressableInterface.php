<?php

namespace Addressable\Bundle\Model;

/**
 * Describes object that are addressable.
 */
interface AddressableInterface
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
