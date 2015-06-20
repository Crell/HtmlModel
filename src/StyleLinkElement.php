<?php

namespace Crell\HtmlModel;


class StyleLinkElement extends LinkElement
{

    public function __construct($href)
    {
        parent::__construct('stylesheet', $href);
    }

}
