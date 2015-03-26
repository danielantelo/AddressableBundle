<?php

namespace Addressable\Bundle\Model\Traits\PHPCR;

use Addressable\Bundle\Document\Address;

/**
 * Trait for implementing addressable on a PHPCR document having address as a child node.
 */
class NestedAddressableTrait
{
    /**
     * @PHPCR\Child(nodeName="address")
     */
    private $address;

    /**
     * Returns the address
     *
     * @return Address
     */
    public function getAddress()
    {
        if (is_null($this->address)) {
            $this->address = new Address();
        }
        return $this->address;
    }

    /**
     * Sets the address
     *
     * @param Address $address
     *
     * @return \Addressable\Bundle\Model\AddressableInterface
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLatitude()
    {
        return $this->address->getLatitude();
    }

    /**
     * {@inheritdoc}
     */
    public function getLongitude()
    {
        return $this->address->getLongitude();
    }
}
