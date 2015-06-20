<?php

namespace Crell\HtmlModel\Head;


class StyleLinkElement extends LinkElement
{

    public function __construct($href)
    {
        parent::__construct('stylesheet', $href);
    }

}
