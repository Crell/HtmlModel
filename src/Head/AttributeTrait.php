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

    /**
     * Returns a single attribute.
     *
     * @param $key
     *   The attribute to return.
     * @return string|int|boolean|array
     *   The attribute, if it exists. Usually this is a string, but could also
     *   be an int, boolean, or array.
     */
    public function getAttribute($key)
    {
        return $this->attributes->get($key);
    }

    /**
     * Returns the attribute bag itself.
     *
     * Note: This may be a bad idea as it violates the Suggestion of Demeter.
     * However, since AttributeBag is stringable it seems reasonable to
     * print $element->getAttributes() and let the magic happen. Open to discussion.
     *
     * @return AttributeBag
     */
    public function getAttributes() {
        return $this->attributes;
    }
}
