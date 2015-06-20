<?php

namespace Crell\HtmlModel;


trait ContentTrait
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
     * @return static
     */
    public function withContent($content)
    {
        $that = clone($this);
        $that->content = $content;
        return $that;
    }
}