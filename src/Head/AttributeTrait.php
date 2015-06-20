<?php

namespace Crell\HtmlModel\Head;


trait AttributeTrait
{

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var array
     */
    protected $allowedAttributes = [];

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
        if (empty($this->allowedAttributes) || in_array($key, $this->allowedAttributes)) {
            $that = clone($this);
            $that->attributes[$key] = $value;
            return $that;
        }
        return $this;
    }

    public function getAttribute($key)
    {
        return isset($this->attributes[$key]) ? $this->attributes[$key] : '';
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

}