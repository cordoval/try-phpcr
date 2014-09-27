<?php

namespace Cordoval\Document;

use Doctrine\ODM\PHPCR\Exception\BadMethodCallException;

class Resource
{
    protected $id;
    protected $node;
    protected $nodename;
    protected $parent;
    protected $data;
    protected $mimeType = 'application/octet-stream';
    protected $encoding;
    protected $lastModified;
    protected $lastModifiedBy;

    public function getNodename()
    {
        return $this->nodename;
    }

    public function setNodename($name)
    {
        $this->nodename = $name;

        return $this;
    }

    public function getParentDocument()
    {
        return $this->parent;
    }

    public function getParent()
    {
        return $this->getParentDocument();
    }

    public function setParentDocument($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    public function setParent($parent)
    {
        return $this->setParentDocument($parent);
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the size of the <strong>stored</strong> data stream in this
     * resource.
     *
     * You should call this method instead of anything else to know the file
     * size as PHPCR implementations are expected to be able to provide this
     * information without needing to to load the actual data stream.
     *
     * Do not use this right after updating data before flushing, as it will
     * only look at the stored data.
     *
     * @return int the resource size in bytes.
     */
    public function getSize()
    {
        if (null === $this->node) {
            throw new BadMethodCallException('Do not call Resource::getSize on unsaved objects, as it only reads the stored size.');
        }

        return $this->node->getProperty('jcr:data')->getLength();
    }

    /**
     * Set the mime type information for this resource.
     *
     * @param string $mimeType
     *
     * @return $this
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * Get the mime type information of this resource.
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     * Set the encoding information for the data stream.
     *
     * @param string $encoding
     *
     * @return $this
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Get the optional encoding information for the data stream.
     *
     * @return string|null the encoding of this resource
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Set the last modified date manually.
     *
     * This might be updated automatically by some PHPCR implementations, but
     * it is not required by the specification.
     *
     * @param \DateTime $lastModified
     *
     * @return $this
     */
    public function setLastModified($lastModified)
    {
        $this->lastModified = $lastModified;

        return $this;
    }

    /**
     * Get the last modified date.
     *
     * @return \DateTime
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * Set the jcr username of the user that last modified this resource.
     *
     * This might be updated automatically by some PHPCR implementations, but
     * it is not required by the specification.
     *
     * @param string $lastModifiedBy
     *
     * @return $this
     */
    public function setLastModifiedBy($lastModifiedBy)
    {
        $this->lastModifiedBy = $lastModifiedBy;

        return $this;
    }

    /**
     * Get the jcr username of the user that last modified this resource.
     *
     * @return string
     */
    public function getLastModifiedBy()
    {
        return $this->lastModifiedBy;
    }

    /**
     * Get mime type and encoding (RFC2045)
     *
     * @return string
     */
    public function getMime()
    {
        return $this->getMimeType() . ($this->getEncoding() ? '; charset=' . $this->getEncoding() : '');
    }

    /**
     * String representation
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->nodename;
    }
}
