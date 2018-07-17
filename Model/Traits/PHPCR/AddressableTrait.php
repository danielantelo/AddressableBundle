<?php

namespace Addressable\Bundle\Model\Traits\PHPCR;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Addressable\Bundle\Validator\Constraints as Address;
use Addressable\Bundle\Model\Traits\Addressable;

/**
 * Trait for implementing addressable on a PHPCR document.
 */
trait AddressableTrait
{
    use Addressable;

    /**
     * @PHPCR\String(nullable=true)
     */
    protected $streetNumber;

    /**
     * @PHPCR\String(nullable=true)
     */
    protected $streetName;

    /**
     * @PHPCR\String(nullable=true)
     */
    protected $city;

    /**
     * @PHPCR\String(nullable=true)
     */
    protected $country;

    /**
     * @PHPCR\String(nullable=true)
     */
    protected $zipCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $administrativeAreaLevel1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $administrativeAreaLevel2;

    /**
     * @PHPCR\Float(nullable=true)
     * @Address\Latitude()
     */
    protected $latitude;

    /**
     * @PHPCR\Float(nullable=true)
     * @Address\Longitude()
     */
    protected $longitude;
}
