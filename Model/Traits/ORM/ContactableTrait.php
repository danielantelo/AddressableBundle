<?php

namespace Addressable\Bundle\Model\Traits\ORM;

use Doctrine\ORM\Mapping as ORM;
use Addressable\Bundle\Model\Traits\Contactable;

/**
 * Trait for implementing contactable on an ORM entity.
 */
trait ContactableTrait
{
    use Contactable;

    /**
     * @var string
     *
     * @ORM\Column(length=100, nullable=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(length=30, nullable=true)
     */
    protected $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(length=30, nullable=true)
     */
    protected $fax;
}
