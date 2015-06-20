<?php

namespace Crell\HtmlModel\Link;


trait LinkModifiersTrait
{

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