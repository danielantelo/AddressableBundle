<?php

namespace Addressable\Bundle\Model;

/**
 * Describes object that are contactable.
 */
interface ContactableInterface
{
    /**
     * Get the email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get the contact phone number
     *
     * @return string
     */
    public function getPhoneNumber();

    /**
     * Get the contact fax number
     *
     * @return string
     */
    public function getFax();
}
