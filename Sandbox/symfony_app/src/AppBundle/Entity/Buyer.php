<?php

namespace AppBundle\Entity;

use Addressable\Bundle\Model\AddressableInterface;
use Addressable\Bundle\Model\Traits\ORM\AddressableTrait;

class Buyer implements AddressableInterface
{
    use AddressableTrait;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $name;

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
