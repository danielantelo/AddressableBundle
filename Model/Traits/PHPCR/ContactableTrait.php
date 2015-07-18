<?php

namespace Addressable\Bundle\Model\Traits\PHPCR;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;

/**
 * Trait for implementing contactable on an ORM entity.
 */
trait ContactableTrait
{
    /**
     * @PHPCR\String(nullable=true)
     */
    protected $email;

    /**
     * @PHPCR\String(nullable=true)
     */
    protected $phoneNumber;

    /**
     * @PHPCR\String(nullable=true)
     */
    protected $fax;

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
}
