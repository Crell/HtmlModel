<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\StyleElement;
use Crell\HtmlModel\Head\StyleLinkElement;

trait StyleContainerTrait
{
    /**
     * A collection of style links on the page.
     *
     * @var StyleLinkElement[]
     */
    private $styleLinks = [];

    /**
     * A collection of inline style elements on the page.
     *
     * @var StyleElement[]
     */
    private $styles = [];

    /**
     * Returns a copy of the page with the style link added.
     *
     * @param StyleLinkElement $element
     *
     * @return static
     */
    public function withStyleLink(StyleLinkElement $element)
    {
        $that = clone($this);
        $that->styleLinks[] = $element;
        return $that;
    }

    /**
     * Returns the style link elements on this page.
     *
     * @return StyleLinkElement[]
     *   The style links on this page.
     */
    public function getStyleLinks()
    {
        return $this->styleLinks;
    }

    /**
     * Returns a copy of the page with the style added.
     *
     * @param StyleElement $element
     *   The style element to add.
     * @return static
     */
    public function withInlineStyle(StyleElement $element)
    {
        $that = clone($this);
        $that->styles[] = $element;
        return $that;
    }

    /**
     * Returns the inline style elements on this page.
     *
     * @return StyleElement[]
     */
    public function getInlineStyles()
    {
        return $this->styles;
    }
}
