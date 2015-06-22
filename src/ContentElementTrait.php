<?php

namespace Crell\HtmlModel;

/**
 * Supporting trait to implement ContentElementInterface.
 */
trait ContentElementTrait
{
    /**
     * The body content of this page.
     *
     * @var string
     */
    private $content = '';

    /**
     * Returns the body of the page.
     *
     * @return string
     *   The body of the Page, that is, everything inside the <body> tag.
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Returns a copy of the page with the body content set.
     *
     * @param string $content
     *   The body of the page to set, that is, everything inside the <body> tag.
     * @return self
     */
    public function withContent($content)
    {
        $that = clone($this);
        $that->content = $content;
        return $that;
    }

    /**
     * Sets the content of this element.
     *
     * Note: This method is only to be called from the constructor. Calling it
     * at any other time is an error as it would violate immutability.
     *
     * @param string $content
     *   The content to set.
     */
    protected function setContent($content)
    {
        $this->content = $content;
    }
}