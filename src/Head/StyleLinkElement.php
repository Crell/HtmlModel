<?php

namespace Crell\HtmlModel\Head;

class StyleLinkElement extends LinkElement
{
    /**
     * @param string $href
     *   The URI of a Stylesheet to reference.
     */
    public function __construct($href)
    {
        $attributes['type'] = 'text/css';
        parent::__construct('stylesheet', $href, $attributes);
    }
}
