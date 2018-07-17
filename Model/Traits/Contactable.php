<?php

namespace Addressable\Bundle\Model\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait for implementing contactable getters and setters
 */
trait Contactable
{
    /**
     * {@inheritdoc}
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Sets the phone number for contact
     *
     * @param string $phoneNumber
     *
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Sets the fax number for contact
     *
     * @param string $fax
     *
     * @return $this
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getContactDetails()
    {
        return array(
            'email' => $this->getEmail(),
            'phoneNumber' => $this->getPhoneNumber(),
            'fax' => $this->getFax(),
        );
    }
    /**
     * Sets all the address fields from an array(
     *       'country' => $this->getCountry(),
     *       'zipCode' => $this->getZipCode(),
     *       'streetNumber' => $this->getStreetNumber(),
     *       'streetName' => $this->getStreetName(),
     *       'administrativeAreaLevel1' => $this->getAdministrativeAreaLevel1(),
     *       'administrativeAreaLevel2' => $this->getAdministrativeAreaLevel2(),
     *       'city' => $this->getCity(),
     *       'latitude' => $this->getLatitude(),
     *       'longitude' => $this->getLongitude()
     *  ).
     *
     * @param array $address
     *
     * @return \Addressable\Bundle\Model\ContactableInterface
     */
    public function setContactDetails(array $details)
    {
        $this->setEmail($details['email']);
        $this->setCity($details['phoneNumber']);
        $this->setZipCode($details['fax']);
    }
}
