<?php

namespace Cordoval\Document;

use Doctrine\ODM\PHPCR\HierarchyInterface;

abstract class AbstractFile implements HierarchyInterface
{
    protected $id;
    protected $node;
    protected $nodename;
    protected $parent;
    protected $created;
    protected $createdBy;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

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

    public function setParentDocument($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function __toString()
    {
        return (string) $this->nodename;
    }
}
