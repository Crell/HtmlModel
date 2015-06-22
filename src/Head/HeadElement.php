<?php

namespace Crell\HtmlModel\Head;


use Crell\HtmlModel\AttributeBag;
use Crell\HtmlModel\ContentElementInterface;
use Crell\HtmlModel\ContentElementTrait;

class HeadElement
{
    use AttributeTrait;

    /**
     * @var string
     */
    protected $element;

    /**
     * @var bool
     */
    private $noScript = false;

    public function __construct()
    {
        $this->attributes = new AttributeBag();
    }

    /**
     * Sets if this element should be wrapped in <noscript>.
     *
     * @param bool $value
     *   (optional) Whether or not this element should be wrapped in <noscript>.
     *   Defaults to TRUE.
     *
     * @return $this
     */
    public function withNoScript($value = TRUE) {
        $that = clone($this);
        $that->noScript = $value;
        return $that;
    }

    public function __toString()
    {
        $string = ($this instanceof ContentElementInterface && $this->getContent())
          ? "<{$this->element}{$this->attributes}>\n{$this->getContent()}\n</{$this->element}>"
          : "<{$this->element}{$this->attributes} />";

        return $this->noScript
          ? "<noscript>$string</noscript>"
          : $string;
    }

    /**
     * Sets a new attribute bag with the specified attributes.
     *
     * This method is only to be used to set defaults from a child class's
     * constructor, as it mutates the object. That's fine within the constructor
     * but at no other time.
     *
     * @param array $attributes
     *   An array of the legal attribute keys for this element, and their default
     *   values. If left empty, all attributes will be legal.
     */
    protected function setAttributes(array $attributes = [])
    {
        $this->attributes = new AttributeBag($attributes);
    }
}
