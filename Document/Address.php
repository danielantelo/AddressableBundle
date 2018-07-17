<?php

namespace Addressable\Bundle\Document;

use Addressable\Bundle\Model\AddressableInterface;
use Addressable\Bundle\Model\Traits\PHPCR\AddressableTrait;
use Addressable\Bundle\Validator\Constraints as AddressValidator;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Document representing an address.
 *
 * @PHPCR\Document()
 */
class Address
{
    use AddressableTrait;

    /**
     * @PHPCR\Id()
     */
    protected $id;

    /**
     * @PHPCR\ParentDocument()
     */
    protected $parent;

    /**
     * @PHPCR\Nodename()
     */
    protected $nodeName;

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
     * Returns node id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Sets node id
     *
     * @param string id
     *
     * @return Address
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Returns node name
     *
     * @return string
     */
    public function getNodeName()
    {
        return $this->nodeName;
    }

    /**
     * Sets node name
     *
     * @param string $nodeName
     *
     * @return Address
     */
    public function setNodeName($nodeName)
    {
        $this->nodeName = $nodeName;

        return $this;
    }

    /**
     * Returns the parent document
     *
     * @return Document
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Sets the parent document
     *
     * @param Document
     *
     * @return Address
     */
    public function setParentDocument($parent)
    {
        $this->parent = $parent;

        return $this;
    }
}
