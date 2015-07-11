<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\HeadElement;

trait HeadElementContainerTrait
{
    /**
     * All of the Header elements for this page.
     *
     * This excludes those head elements that have their own properties.
     *
     * @var HeadElement[]
     */
    private $headElements = [];

    /**
     * {@inheritDoc}
     */
    public function withHeadElement(HeadElement $element)
    {
        $that = clone($this);
        $that->headElements[] = $element;
        return $that;
    }

    /**
     * {@inheritDoc}
     */
    public function getHeadElements()
    {
        return $this->headElements;
    }

}
