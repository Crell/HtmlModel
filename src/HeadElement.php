<?php

namespace Crell\HtmlModel;


class HeadElement
{
    /**
     * @var string
     */
    private $element;

    /**
     * @var bool
     */
    private $noScript = false;

    /**
     * @var string
     */
    private $content;

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var array
     */
    protected $allowedAttributes = [];

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

    /**
     * Returns a copy of the element with the attribute set.
     *
     * Note: If the specified attribute is not legal on this element as
     * specified by the allowedAttributes property, the object will not be
     * changed and the same object will be returned.
     *
     * @param string $key
     *   The attribute to set.
     * @param string|array $value
     *   The value to which to set it.
     *
     * @return $this
     */
    protected function withAttribute($key, $value) {
        if (in_array($key, $this->allowedAttributes)) {
            $that = clone($this);
            $that->attributes[$key] = $value;
            return $that;
        }
        return $this;
    }

    /**
     * Sets the value of an attribute directly.
     *
     * This method is only to be used to set defaults from a child class's
     * constructor, or for setting attributes that are required by other
     * attributes.
     *
     * @param string $key
     * @param string|array $value
     */
    protected function setAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function __toString()
    {
        // Remove any empty or false values.
        $attributes = array_filter($this->attributes);
        $attributes = array_map([$this,'renderAttribute'], array_keys($attributes), array_values($attributes));
        $attributeString = ' ' . implode(' ', $attributes);

        $string = $this->content
          ? "<{$this->element}{$attributeString}>\n{$this->content}\n</{$this->element}"
          : "<{$this->element}{$attributeString} />";

        return $this->noScript
          ? "<noscript>$string</noscript>"
          : $string;
    }

    private function renderAttribute($key, $value)
    {
        if (is_bool($value)) {
            return $key;
        }

        // @todo We may need to special case some attributes. Sigh.
        if (is_array($value)) {
            $value = implode(' ', $value);
        }

        return "{$key}=\"{$value}\"";
    }
}
