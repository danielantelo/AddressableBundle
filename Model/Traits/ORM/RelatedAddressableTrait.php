<?php

namespace Addressable\Bundle\Model\Traits\PHPCR;

use Addressable\Bundle\Entity\Address;

/**
 * Trait for implementing addressable on an ORM entity having address as a relation.
 */
class RelatedAddressableTrait
{
    /**
     * @ManyToOne(targetEntity="Addressable\Bundle\Entity\Address")
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
