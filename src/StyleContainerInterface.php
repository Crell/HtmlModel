<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\StyleElement;
use Crell\HtmlModel\Head\StyleLinkElement;

interface StyleContainerInterface
{
    /**
     * Returns a copy of the page with the style link added.
     *
     * @param StyleLinkElement $element
     *
     * @return static
     */
    public function withStyleLink(StyleLinkElement $element);

    /**
     * Returns the style link elements on this page.
     *
     * @return StyleLinkElement[]
     *   The style links on this page.
     */
    public function getStyleLinks() : array;

    /**
     * Returns a copy of the page with the style added.
     *
     * @param StyleElement $element
     *   The style element to add.
     * @return static
     */
    public function withInlineStyle(StyleElement $element);

    /**
     * Returns the inline style elements on this page.
     *
     * @return StyleElement[]
     */
    public function getInlineStyles() : array;
}
