<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\HeadElement;
use Crell\HtmlModel\Head\ScriptElement;
use Crell\HtmlModel\Link\Linkable;
use Crell\HtmlModel\Link\LinkInterface;


class HtmlPage implements Linkable
{
    /**
     * Attributes for the HTML element.
     *
     * @var AttributeBag
     */
    private $htmlAttributes;

    /**
     * Attributes for the BODY element.
     *
     * @var AttributeBag
     */
    private $bodyAttributes;

    /**
     * The HTTP status code of this page.
     *
     * @var int
     */
    private $statusCode = 200;

    /**
     * All of the Header elements for this page.
     *
     * @var array
     */
    private $headElements = [];

    /**
     * The body content of this page.
     *
     * @var string
     */
    private $content = '';

    /**
     * The title of the page.
     *
     * This value will be used in the <title> tag verbatim.
     *
     * @var string
     */
    private $title = '';

    /**
     * Constructs a new HtmlPage.
     *
     * @param string $content
     *   The body content of the page.
     * @param string $title
     *   The title of the page.
     */
    public function __construct($content = '', $title = '')
    {
        $this->title = $title;
        $this->content = $content;
        $this->htmlAttributes = new AttributeBag();
        $this->bodyAttributes = new AttributeBag();
    }

    /**
     * Returns the HTML attributes for this HTML page.
     *
     * @return AttributeBag
     */
    public function getHtmlAttributes() {
        return $this->htmlAttributes;
    }

    /**
     * Returns a copy of the page with the HTML attribute set.
     *
     * @param string $key
     *   The attribute to set.
     * @param string|array $value
     *   The value to which to set it.
     *
     * @return $this
     */
    public function withHtmlAttribute($key, $value)
    {
        return $this->withAttributeHelper('htmlAttributes', $key, $value);
    }

    /**
     * Returns the HTML attributes for the body element of this page.
     *
     * @return AttributeBag
     */
    public function getBodyAttributes() {
        return $this->bodyAttributes;
    }

    /**
     * Returns a copy of the page with the BODY attribute set.
     *
     * @param string $key
     *   The attribute to set.
     * @param string|array $value
     *   The value to which to set it.
     *
     * @return $this
     */
    public function withBodyAttribute($key, $value)
    {
        return $this->withAttributeHelper('bodyAttributes', $key, $value);
    }

    /**
     * Returns a copy of the page with the provided HeadElement added.
     *
     * @param HeadElement $element
     *   The HeadElement to add.
     * @return static
     */
    public function withHeadElement(HeadElement $element)
    {
        $that = clone($this);
        $that->headElements[] = $element;
        return $that;
    }

    /**
     * Returns the Script elements on this Page.
     *
     * @todo Make scopes work.
     *
     * @param string $scope
     *   (optional) The scope for which the JavaScript rules should be returned.
     *   Defaults to 'header'.
     *
     * @return string
     *   All JavaScript code segments and includes for the scope as HTML tags.
     */
    public function getScripts($scope = 'header') {
        return array_filter($this->headElements, function(HeadElement $element) {
            return $element instanceof ScriptElement;
        });
    }

    /**
     * Returns a themed representation of all stylesheets to attach to the page.
     *
     * @return string
     *   A string of XHTML CSS tags.
     */
    public function getStyles() {

    }

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

    /**
     * Returns the title of the page.
     *
     * @return string
     *   The title of the Page.
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Returns a copy of the page with the title set.
     *
     * @param string $title
     *   The title of the page to set.
     *
     * @return static
     */
    public function withTitle($title)
    {
        $that = clone($this);
        $that->title = $title;
        return $that;
    }

    /**
     * Returns the status code of this response.
     *
     * @return int
     *   The status code of this page.
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function withStatusCode($code)
    {
        if ($this->statusCode == $code) {
            return $this;
        }

        $that = clone($this);
        $that->statusCode = $code;
        return $that;
    }

    /**
     * {@inheritdoc}
     */
    public function getLinks()
    {
        return array_filter($this->headElements, function(HeadElement $element) {
            return $element instanceof LinkInterface;
        });
    }

    /**
     * Return a new object with the particular attribute on the specified collection set.
     *
     * This is just a helper to collapse HTML and BODY handling.
     *
     * @param $collection
     *   Either htmlAttributes or bodyAttributes.
     * @param string $key
     *   The attribute to set.
     * @param string $value
     *   The value to which to set it.
     *
     * @return $this|\Crell\HtmlModel\HtmlPage
     */
    private function withAttributeHelper($collection, $key, $value)
    {
        $newAttributes = $this->$collection->withAttribute($key, $value);

        // If there was no change, don't bother changing this object either.
        if ($newAttributes === $this->$collection) {
            return $this;
        }

        $that = clone($this);
        $that->$collection = $newAttributes;

        return $that;
    }
}
