<?php

namespace Crell\HtmlModel\Head;

class BaseElement extends HeadElement
{
    protected $element = 'base';

    /**
     * Constructs a new BaseElement.
     *
     * @param string $href
     *   The base URL to be used throughout the document for relative URL addresses.
     * @param string $target
     *   A name or keyword indicating the default location to display the result when hyperlinks or forms cause navigation.
     */
    public function __construct(string $href, string $target = '')
    {
        $this->setAttributes([
          'href' => $href, // The base URL to be used throughout the document for relative URL addresses.
          'target' => $target, // A name or keyword indicating the default location to display the result when hyperlinks or forms cause navigation.
        ]);
    }
}
