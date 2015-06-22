<?php

namespace Crell\HtmlModel;


/**
 * A collection of attributes on an HTML element.
 *
 * @todo Add support for multi-value attributes, like class.
 */
class AttributeBag implements \Countable
{

    /**
     * @var array
     */
    private $attributes = [];

    /**
     * @var bool
     */
    private $restricted = false;

    public function __construct(array $defaults = [])
    {
        if ($defaults) {
            $this->attributes = $defaults;
            $this->restricted = true;
        }
    }

    /**
     * @param $offset
     *
     * @return bool
     */
    public function has($offset)
    {
        return isset($this->attributes[$offset]);
    }

    /**
     * @param $offset
     *
     * @return string
     */
    public function get($offset)
    {
        return isset($this->attributes[$offset]) ? $this->attributes[$offset] : '';
    }

    /**
     * Returns a new instance of the object, with the attribute set.
     *
     * If a list of allowed attributes was provided and the specified
     * attribute is not in that list, this method will be a no-op.
     *
     * @param string $offset
     * @param string $value
     * @return self
     *
     */
    public function withAttribute($offset, $value)
    {
        if ($this->restricted) {
            if (!in_array($offset, array_keys($this->attributes))) {
                return $this;
            }
        }

        $that = clone($this);
        $that->attributes[$offset] = $value;
        return $that;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($offset)
    {
        // If it's already not here, do nothing.
        if (!isset($this->attributes[$offset])) {
            return $this;
        }

        // We can't actually unset it, because if this is a restricted
        // attribute bag then we cannot then set it later. Instead, set it to
        // false so that it will get filtered out when rendered.
        $that = clone($this);
        $that->attributes[$offset] = false;
        return $that;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->attributes);
    }

    public function __toString()
    {
        // Remove any empty or false values.
        $attributes = array_filter(array_map([$this,'renderAttribute'], array_keys($this->attributes), array_values($this->attributes)));

        return $attributes
          ? ' ' . implode(' ', $attributes)
          : '';
    }

    private function renderAttribute($key, $value)
    {
        if (!$value) {
            return '';
        }

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
