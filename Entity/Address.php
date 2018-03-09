<?php

namespace Addressable\Bundle\Entity;

use Addressable\Bundle\Model\AddressableInterface;
use Addressable\Bundle\Validator\Constraints as AddressValidator;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity representing an address.
 * You must extend this class and add an id and entity annotation.
 */
class Address
{
    /**
     * @ORM\Column(type="string")
     */
    protected $streetNumber;

    /**
     * @ORM\Column(type="string")
     */
    protected $streetName;

    /**
     * @ORM\Column(type="string")
     */
    protected $city;

    /**
     * @ORM\Column(type="string")
     */
    protected $zipCode;

    /**
     * @ORM\Column(type="string")
     */
    protected $country;

    /**
     * @ORM\Column(type="string")
     */
    protected $administrativeAreaLevel1;

    /**
     * @ORM\Column(type="string")
     */
    protected $administrativeAreaLevel2;

    /**
     * @ORM\Column(type="float")
     * @AddressValidator\Latitude()
     */
    protected $latitude;

    /**
     * @ORM\Column(type="float")
     * @AddressValidator\Longitude()
     */
    protected $longitude;

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $address = sprintf(
            '%s %s %s %s %s',
            $this->getStreetNumber(),
            $this->getStreetName(),
            $this->getCity(),
            $this->getCountry(),
            $this->getZipCode()
        );

        return $address;
    }

    /**
     * Returns node name
     *
     * @return string
     */
    public function getNodeName()
    {
        return $this->nodeName;
    }

    /**
     * Sets node name
     *
     * @param string $nodeName
     *
     * @return Address
     */
    public function setNodeName($nodeName)
    {
        $this->nodeName = $nodeName;

        return $this;
    }

    /**
     * Returns the parent document
     *
     * @return Document
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Sets the parent document
     *
     * @param Document
     *
     * @return Address
     */
    public function setParentDocument($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Returns the country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Sets the country
     *
     * @param string $country
     *
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Returns the postal code
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Sets the postal code
     *
     * @param string $zipCode
     *
     * @return Address
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Returns the street number
     *
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Sets the street number
     *
     * @param string $streetNumber
     *
     * @return Address
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * Returns the street name
     *
     * @return string
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * Sets the street name
     *
     * @param string $streetName
     *
     * @return Address
     */
    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * Returns the city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Returns the latitude
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Sets the latitude
     *
     * @param float $latitude
     *
     * @return Address
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Returns the longitude
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Sets the longitude
     *
     * @param float $longitude
     *
     * @return Address
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAdministrativeAreaLevel1()
    {
        return $this->administrativeAreaLevel1;
    }

    /**
     * @param mixed $administrativeAreaLevel1
     */
    public function setAdministrativeAreaLevel1($administrativeAreaLevel1)
    {
        $this->administrativeAreaLevel1 = $administrativeAreaLevel1;
    }

    /**
     * @return mixed
     */
    public function getAdministrativeAreaLevel2()
    {
        return $this->administrativeAreaLevel2;
    }

    /**
     * @param mixed $administrativeAreaLevel2
     */
    public function setAdministrativeAreaLevel2($administrativeAreaLevel2)
    {
        $this->administrativeAreaLevel2 = $administrativeAreaLevel2;
    }
}
