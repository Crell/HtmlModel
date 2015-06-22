<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\BaseElement;
use Crell\HtmlModel\Head\HeadElement;
use Crell\HtmlModel\Link\Linkable;
use Crell\HtmlModel\Link\LinkInterface;

/**
 * Value object representing an entire HTML page.
 */
class HtmlPage implements Linkable, ContentElementInterface, StatusCodeContainerInterface, StyleContainerInterface, ScriptContainerInterface
{
    use ContentElementTrait;
    use StyleContainerTrait;
    use ScriptContainerTrait;
    use StatusCodeContainerTrait;

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
     * All of the Header elements for this page.
     *
     * This excludes those head elements that have their own properties.
     *
     * @var HeadElement[]
     */
    private $headElements = [];

    /**
     * The base element for this page, if any.
     *
     * @var BaseElement
     */
    private $baseElement;

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
     * Returns the page with the base element set.
     *
     * @todo Should this take a string instead of an ElementObject?
     *
     * @param BaseElement $base
     *   The base element to set.
     * @return self
     */
    public function withBase(BaseElement $base)
    {
        $that = clone($this);
        $that->baseElement = $base;
        return $that;
    }

    /**
     * Returns the page with the base element unset.
     *
     * @return static
     */
    public function withoutBase()
    {
        $that = clone($this);
        $that->baseElement = NULL;
        return $that;
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
     * Returns an array of all Head elements on this object.
     *
     * Remember that some head-scoped elements may have their own alternate
     * colletions and won't be included here.
     *
     * @return HeadElement[]
     */
    public function getHeadElements()
    {
        return $this->headElements;
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
