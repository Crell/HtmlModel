<?php

namespace Crell\HtmlModel\Head;

use Crell\HtmlModel\ContentElementInterface;
use Crell\HtmlModel\ContentElementTrait;

class StyleElement extends HeadElement implements ContentElementInterface
{
    use ContentElementTrait;

    protected $element = 'style';

    /**
     * Constructs a new StyleElement.
     *
     * @param string $content
     *   The content of the element. This is virtually always a CSS string.
     */
    public function __construct($content)
    {
        $this->setContent($content);
        $this->setAttributes([
            'type' => 'text/css', // The mime type of the style, with no charset.
            'media' => '',        // Which media should this style apply to. This may be any valid media query. If not set, a client will assume "all".
            'title' => '',        // Specifies alternative style sheet sets.
            'disabled' => false,  // Boolean. If set disables (does not apply) the style rules, specified within the element, to the Document.
        ]);
    }
}
