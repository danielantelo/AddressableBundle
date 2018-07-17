<?php

namespace Addressable\Bundle\Model\Traits\PHPCR;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Addressable\Bundle\Model\Traits\Contactable;

/**
 * Trait for implementing contactable on an ORM entity.
 */
trait ContactableTrait
{
    use Contactable;

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
}
