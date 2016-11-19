<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\BaseElement;
use Crell\HtmlModel\Head\HeadElement;
use Fig\Link\EvolvableLinkProviderTrait;
use Psr\Link\EvolvableLinkProviderInterface;
use Psr\Link\LinkInterface;

/**
 * Value object representing an entire HTML page.
 */
class HtmlPage implements HtmlPageInterface, EvolvableLinkProviderInterface
{
    use ContentElementTrait;
    use StyleContainerTrait;
    use ScriptContainerTrait;
    use StatusCodeContainerTrait;
    use HeadElementContainerTrait;
    use EvolvableLinkProviderTrait;

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
     * {@inheritDoc}
     */
    public function withBase(BaseElement $base)
    {
        $that = clone($this);
        $that->baseElement = $base;
        return $that;
    }

    /**
     * {@inheritDoc}
     */
    public function withoutBase()
    {
        $that = clone($this);
        $that->baseElement = null;
        return $that;
    }

    /**
     * {@inheritDoc}
     */
    public function getBase()
    {
        return $this->baseElement;
    }

    /**
     * {@inheritDoc}
     */
    public function getHtmlAttributes()
    {
        return $this->htmlAttributes;
    }

    /**
     * {@inheritDoc}
     */
    public function withHtmlAttribute($key, $value)
    {
        return $this->withAttributeHelper('htmlAttributes', $key, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getBodyAttributes()
    {
        return $this->bodyAttributes;
    }

    /**
     * {@inheritDoc}
     */
    public function withBodyAttribute($key, $value)
    {
        return $this->withAttributeHelper('bodyAttributes', $key, $value);
    }

    /**
     * {@inheritDoc}
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * {@inheritDoc}
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
        return array_merge($this->getStyleLinks(), array_filter($this->getHeadElements(), function (HeadElement $element) {
            return $element instanceof LinkInterface;
        }));
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
     * @return static
     */
    private function withAttributeHelper($collection, $key, $value)
    {
        $newAttributes = $this->$collection->withAttribute($key, $value);

        $that = clone($this);
        $that->$collection = $newAttributes;

        return $that;
    }

    /**
     * {@inheritDoc}
     */
    public function getAllHeadElements()
    {
        return array_merge(
          [$this->getBase()],
          $this->getHeadElements(),
          $this->getStyleLinks(),
          $this->getInlineStyles(),
          $this->getScripts('header'));
    }

    /**
     * Renders this page object to an HTML string.
     *
     * @return string
     */
    public function __toString()
    {
        $title = $this->getTitle() ? "<title>{$this->getTitle()}</title>" : '';
        $head = implode(PHP_EOL, $this->getAllHeadElements());
        $footer_scripts = implode(PHP_EOL, $this->getScripts('footer'));

        $out = <<<END
<html{$this->getHtmlAttributes()}>
<head>
{$title}
{$head}
</head>
<body>
{$this->getContent()}
{$footer_scripts}
</body>
</html>
END;

        return $out;
    }
}
