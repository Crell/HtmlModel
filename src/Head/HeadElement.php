<?php

namespace Crell\HtmlModel\Head;


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

    /**
     * @var string
     */
    private $content;

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

    protected function setContent($content)
    {
        $this->content = $content;
    }

    public function __toString()
    {
        // Remove any empty or false values.
        $attributes = array_filter($this->attributes);
        $attributes = array_map([$this,'renderAttribute'], array_keys($attributes), array_values($attributes));
        $attributeString = ' ' . implode(' ', $attributes);

        $string = $this->content
          ? "<{$this->element}{$attributeString}>\n{$this->content}\n</{$this->element}>"
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
