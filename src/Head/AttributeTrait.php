<?php

namespace Crell\HtmlModel\Head;

use Crell\HtmlModel\AttributeBag;


trait AttributeTrait
{

    /**
     * @var AttributeBag
     */
    private $attributes;

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
     * @return self
     */
    public function withAttribute($key, $value) {
        $newAttributes = $this->attributes->withAttribute($key, $value);

        // If there was no change, don't bother changing this object either.
        if ($newAttributes === $this->attributes) {
            return $this;
        }

        $that = clone($this);
        $that->attributes = $newAttributes;

        return $that;
    }


    /**
     * Returns a copy of the element with the attribute removed.
     *
     * @param $key
     *   The offset to remove.
     * @return self
     */
    public function withoutAttribute($key)
    {
        $newAttributes = $this->attributes->withoutAttribute($key);
        $that = clone($this);
        $that->attributes = $newAttributes;
        return $that;
    }

    public function getAttribute($key)
    {
        return $this->attributes->get($key);
    }


    public function getAttributes() {
        return $this->attributes;
    }
}
