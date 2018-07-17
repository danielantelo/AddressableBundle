<?php

namespace Addressable\Bundle\Entity;

use Addressable\Bundle\Model\AddressableInterface;
use Addressable\Bundle\Model\Traits\ORM\AddressableTrait;
use Addressable\Bundle\Validator\Constraints as AddressValidator;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Entity representing an address.
 * You must extend this class and add an id and entity annotation.
 */
class Address implements AddressableInterface
{
    use AddressableTrait;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
