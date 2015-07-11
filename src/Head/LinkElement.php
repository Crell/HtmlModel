<?php

namespace Crell\HtmlModel\Head;

use Crell\HtmlModel\Link\LinkInterface;
use Crell\HtmlModel\Link\LinkModifiersTrait;
use Crell\HtmlModel\Link\ModifiableLinkInterface;

class LinkElement extends HeadElement implements LinkInterface, ModifiableLinkInterface
{
    use LinkModifiersTrait;

    protected $element = 'link';

    public function __construct($rel, $href)
    {
        // @todo Add the full list of allows attributes.
        // See https://developer.mozilla.org/en-US/docs/Web/HTML/Element/link
        $this->setAttributes([
            'rel' => $rel,
            'href' => $href,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getHref()
    {
        return $this->getAttribute('href');
    }

    /**
     * {@inheritdoc}
     */
    public function getRel()
    {
        return $this->getAttribute('rel');
    }
}
