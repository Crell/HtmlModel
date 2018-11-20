<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\HeadElement;

interface HeadElementContainerInterface
{
    /**
     * Returns a copy of the page with the provided HeadElement added.
     *
     * @param HeadElement $element
     *   The HeadElement to add.
     *
     * @return static
     */
    public function withHeadElement(HeadElement $element);

    /**
     * Returns an array of all Head elements on this object.
     *
     * Remember that some head-scoped elements may have their own alternate
     * colletions and won't be included here.
     *
     * @return HeadElement[]
     */
    public function getHeadElements() : array;
}
