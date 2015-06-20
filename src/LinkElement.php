<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Link\LinkInterface;
use Crell\HtmlModel\Link\ModifiableLinkInterface;

class LinkElement extends HeadElement implements LinkInterface, ModifiableLinkInterface
{
    protected $element = 'link';

    public function __construct($rel, $href)
    {
        $this->setAttribute('rel', $rel);
        $this->setAttribute('href', $href);
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

    /**
     * {@inheritdoc}
     */
    public function withHref($href)
    {
        return $this->withAttribute('href', $href);
    }

    /**
     * {@inheritdoc}
     */
    public function withRel($rel)
    {
        return $this->withAttribute('rel', $rel);
    }

    /**
     * {@inheritdoc}
     */
    public function withAttribute($key, $value)
    {
        return parent::withAttribute($key, $value);
    }

}
