<?php

namespace Daa\AddressableBundle\Model\Traits\ORM;

use Doctrine\ORM\Mapping as ORM;

trait AddressableTrait
{
    /**
     * @ORM\Column(type="text")
     */
    protected $country;

    /**
     * @ORM\Column(type="text")
     */
    protected $zipCode;

    /**
     * @ORM\Column(type="text")
     */
    protected $streetNumber;

    /**
     * @ORM\Column(type="text")
     */
    protected $streetName;

    /**
     * @ORM\Column(type="text")
     */
    protected $city;

    /**
     * @ORM\Column(type="float")
     */
    protected $latitude;

    /**
     * @ORM\Column(type="float")
     */
    protected $longitude;

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    public function getStreetName()
    {
        return $this->streetName;
    }

    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

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

    public function setAddress(Array $address)
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
