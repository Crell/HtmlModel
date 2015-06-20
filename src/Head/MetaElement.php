<?php

namespace Crell\HtmlModel\Head;


class MetaElement extends HeadElement
{

    protected $element = 'meta';

    // @Skipping for now; come back when we refactor it to a collection object.
    protected $allowedAttributes = [];

    public function __construct($contentAttribute, array $attributes = [])
    {
        $this->setAttribute('content', $contentAttribute);
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

}
