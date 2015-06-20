<?php

namespace Crell\HtmlModel\Link;


class Link implements LinkInterface, ModifiableLinkInterface
{
    use LinkTrait;
    use LinkModifiersTrait;

    public function __construct($rel, $href)
    {
        $this->rel = $rel;
        $this->href = $href;
    }
}
