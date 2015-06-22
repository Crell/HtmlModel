<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\BaseElement;
use Crell\HtmlModel\Head\HeadElement;
use Crell\HtmlModel\Head\ScriptElement;
use Crell\HtmlModel\Head\StyleElement;
use Crell\HtmlModel\Head\StyleLinkElement;
use Crell\HtmlModel\Link\Linkable;
use Crell\HtmlModel\Link\LinkInterface;


class HtmlPage implements Linkable, ContentElementInterface
{
    use ContentElementTrait;

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
     * This excludes those head elements that have their own properties.
     *
     * @var HeadElement[]
     */
    private $headElements = [];

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
     * A collection of the scripts defined for this page.
     *
     * Both the header and footer arrays are an array of ScriptElement objects.
     *
     * @todo: Should this be a more formal data structure? Probably.
     *
     * @var array
     */
    private $scripts = [
      'header' => [],
      'footer' => [],
    ];

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
     * Returns a copy of the page with the script added.
     *
     * @param ScriptElement $script
     * @param string $scope
     *   The scope in which the script should be defined. Legal values are "header"
     *   (i.e., in the <head> element) and "footer" (i.e., right before </body>).
     *
     * @return static
     */
    public function withScript(ScriptElement $script, $scope = 'header')
    {
        // These are the only legal values.
        assert('in_array($scope, [\'header\', \'footer\'])');

        $that = clone($this);
        $this->scripts[$scope][] = $script;
        return $that;
    }

    /**
     * Returns the Script elements on this Page.
     *
     * @todo Make scopes work.
     *
     * @param string $scope
     *   The scope for which to return Script elements.
     *
     * @return ScriptElement[]
     *   All JavaScript elements for the specified scope.
     */
    public function getScripts($scope = 'header') {
        return $this->scripts[$scope];
    }

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

    /**
     * Returns a copy of the page with the status code set.
     *
     * @param int $code
     *   The status code to set.
     * @return static
     */
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
