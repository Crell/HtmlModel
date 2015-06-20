<?php

namespace Crell\HtmlModel;


class Link implements LinkInterface
{
    use LinkTrait;

    public function __construct($href, $rel)
    {
        $this->href = $href;
        $this->rel = $rel;
    }

    public function withHref($href)
    {
        $that = clone($this);
        $that->href = $href;
        return $that;
    }

    public function withRel($rel)
    {
        $that = clone($this);
        $that->rel = $rel;
        return $that;
    }

    public function withAttribute($key, $value)
    {
        $that = clone($this);
        $that->attributes[$key] = $value;
        return $that;
    }

}
