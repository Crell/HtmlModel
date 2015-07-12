<?php

namespace Crell\HtmlModel\Head;

class MetaCharsetElement extends MetaElement
{
    /**
     * Constructs a new MetaCharset element.
     *
     * @param string $charset
     *   A character set that will apply to the whole page. Rarely will
     *   something other than UTF-8 be used.
     */
    public function __construct($charset = 'UTF-8')
    {
        parent::__construct([
            'charset' => $charset,
        ]);
    }
}
