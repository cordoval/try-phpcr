<?php

namespace Cordoval\Document;

use Doctrine\Common\Collections\ArrayCollection;

class Generic
{
    protected $id;
    protected $node;
    protected $nodename;
    protected $parent;
    protected $children;
    protected $referrers;

    public function getId()
    {
        return $this->id;
    }

    public function getNode()
    {
        return $this->node;
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

    public function getParent()
    {
        return $this->getParentDocument();
    }

    public function setParent($parent)
    {
        return $this->setParentDocument($parent);
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setChildren(ArrayCollection $children)
    {
        $this->children = $children;

        return $this;
    }

    public function addChild($child)
    {
        if (null === $this->children) {
            $this->children = new ArrayCollection();
        }

        $this->children->add($child);

        return $this;
    }

    public function getReferrers()
    {
        return $this->referrers;
    }

    public function setReferrers(ArrayCollection $referrers)
    {
        $this->referrers = $referrers;

        return $this;
    }

    public function addReferrer($referrer)
    {
        if (null === $this->referrers) {
            $this->referrers = new ArrayCollection();
        }

        $this->referrers->add($referrer);

        return $this;
    }

    public function __toString()
    {
        return (string) $this->nodename;
    }
}
