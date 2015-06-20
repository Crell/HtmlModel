<?php

namespace Crell\HtmlModel\Head;


class StyleElement extends HeadElement
{
    protected $element = 'style';

    protected $allowedAttributes = [
        'type', // The mime type of the style, with no charset.
        'media', // Which media should this style apply to. This may be any valid media query. If not set, a client will assume "all".
        'title', // Specifies alternative style sheet sets.
        'disabled', // Boolean. If set disables (does not apply) the style rules, specified within the element, to the Document.
    ];

    public function __construct($content)
    {
        $this->setContent($content);
        $this->setAttribute('type', 'text/css');
    }
}
