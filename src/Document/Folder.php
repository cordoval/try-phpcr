<?php

namespace Cordoval\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\PHPCR\HierarchyInterface;

class Folder extends AbstractFile
{
    protected $children;
    protected $child;

    public function getChildren()
    {
        return $this->children;
    }

    public function setChildren(ArrayCollection $children)
    {
        $this->children = $children;

        return $this;
    }

    public function addChild(HierarchyInterface $child)
    {
        if (null === $this->children) {
            $this->children = new ArrayCollection();
        }

        $this->children->add($child);

        return $this;
    }
}
