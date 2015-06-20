<?php

namespace Crell\HtmlModel\Head;


class BaseElement extends HeadElement
{

    protected $element = 'base';

    protected $allowedAttributes = [
        'href', // The base URL to be used throughout the document for relative URL addresses.
        'target', // A name or keyword indicating the default location to display the result when hyperlinks or forms cause navigation.
    ];

    public function __construct($href, $target = '')
    {
        $this->setAttribute('href', $href);
        $this->setAttribute('target', $target);
    }
}
