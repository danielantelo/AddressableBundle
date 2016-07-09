<?php

namespace Addressable\Bundle\Model\Traits\ORM;

use Doctrine\ORM\Mapping as ORM;
use Addressable\Bundle\Validator\Constraints as Address;

/**
 * Trait for implementing addressable on an ORM entity.
 */
trait AddressableTrait
{
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $streetNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $streetName;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    protected $country;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $zipCode;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Address\Latitude()
     */
    protected $latitude;

    /**
     * @ORM\Column(type="float", nullable=true)
     * @Address\Longitude()
     */
    protected $longitude;

    /**
     * {@inheritdoc}
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Sets the country.
     *
     * @param string $country
     *
     * @return \Addressable\Bundle\Model\AddressableInterface
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Sets the postal code aka zip code.
     *
     * @param string $zipCode
     *
     * @return \Addressable\Bundle\Model\AddressableInterface
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Sets the street number.
     *
     * @param string $streetNumber
     *
     * @return \Addressable\Bundle\Model\AddressableInterface
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * Sets the street name.
     *
     * @param string $streetName
     *
     * @return \Addressable\Bundle\Model\AddressableInterface
     */
    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the city.
     *
     * @param string $city
     *
     * @return \Addressable\Bundle\Model\AddressableInterface
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Sets the latitude.
     *
     * @param string $latitude
     *
     * @return \Addressable\Bundle\Model\AddressableInterface
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Sets the longitude.
     *
     * @param string $longitude
     *
     * @return \Addressable\Bundle\Model\AddressableInterface
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getAddress()
    {
        return array(
            'country' => $this->getCountry(),
            'zipCode' => $this->getZipCode(),
            'streetNumber' => $this->getStreetNumber(),
            'streetName' => $this->getStreetName(),
            'city' => $this->getCity(),
            'latitude' => $this->getLatitude(),
            'longitude' => $this->getLongitude(),
        );
    }
    /**
     * Sets all the address fields from an array(
     *       'country' => $this->getCountry(),
     *       'zipCode' => $this->getZipCode(),
     *       'streetNumber' => $this->getStreetNumber(),
     *       'streetName' => $this->getStreetName(),
     *       'city' => $this->getCity(),
     *       'latitude' => $this->getLatitude(),
     *       'longitude' => $this->getLongitude()
     *  ).
     *
     * @param array $address
     *
     * @return \Addressable\Bundle\Model\AddressableInterface
     */
    public function setAddress(array $address)
    {
        $this->setCountry($address['country']);
        $this->setCity($address['city']);
        $this->setZipCode($address['zipCode']);
        $this->setStreetNumber($address['streetNumber']);
        $this->setStreetName($address['streetName']);
        $this->setLatitude($address['latitude']);
        $this->setLongitude($address['longitude']);
    }
}
