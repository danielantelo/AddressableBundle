<?php

namespace Addressable\Bundle\Model;

/**
 * Allows you to make an object addressable
 * e.g. Property, Event, etc.
 */
interface AddressableInterface
{
    /**
     * Returns the associated country.
     *
     * @return string
     */
    public function getCountry();

    /**
     * Returns the associated postcode.
     *
     * @return string
     */
    public function getZipCode();

    /**
     * Returns the associated street number.
     *
     * @return string
     */
    public function getStreetNumber();

    /**
     * Returns the associated street number.
     *
     * @return string
     */
    public function getStreetName();

    /**
     * Returns the latitude of the address.
     *
     * @return string
     */
    public function getLatitude();

    /**
     * Returns the latitude of the address.
     *
     * @return string
     */
    public function getLongitude();

    /**
     * Returns all address fields in an array(
     *       'country' => $this->getCountry(),
     *       'zipCode' => $this->getZipCode(),
     *       'streetNumber' => $this->getStreetNumber(),
     *       'streetName' => $this->getStreetName(),
     *       'city' => $this->getCity(),
     *       'latitude' => $this->getLatitude(),
     *       'longitude' => $this->getLongitude()
     *  ).
     *
     * @return array
     */
    public function getAddress();
}
