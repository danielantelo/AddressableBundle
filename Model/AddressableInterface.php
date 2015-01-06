<?php

namespace Addressable\Bundle\Model;

/**
 * Allows you to make a document addressable
 * e.g. Property and University have addresses
 *
 * @author dantelo
 */
interface AddressableInterface
{
    /**
     * Returns the associated country
     *
     * @return String
     */
    public function getCountry();

    /**
     * Returns the associated postcode
     *
     * @return String
     */
    public function getZipCode();

    /**
     * Returns the associated street number
     *
     * @return String
     */
    public function getStreetNumber();

    /**
     * Returns the latitude of the address
     *
     * @return String
     */
    public function getLatitude();

    /**
     * Returns the latitude of the address
     *
     * @return String
     */
    public function getLongitude();

    /**
     * Returns all address fields in an array
     * array(
     *       'country' => $this->getCountry(),
     *       'zipCode' => $this->getZipCode(),
     *       'streetNumber' => $this->getStreetNumber(),
     *       'streetName' => $this->getStreetName(),
     *       'city' => $this->getCity(),
     *       'latitude' => $this->getLatitude(),
     *       'longitude' => $this->getLongitude()
     *  );
     *
     * @return Array
     */
    public function getAddress();
}
