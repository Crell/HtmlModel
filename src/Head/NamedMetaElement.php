<?php

namespace Crell\HtmlModel\Head;

class NamedMetaElement extends MetaElement
{
    /**
     * Constructs a named meta element.
     *
     * @param string $name
     *   The name of the element, for the name attribute.
     * @param string $contentAttribute
     *   The value of the 'content' attribute of the element. Its significance
     *   varies depending on the $name.
     */
    public function __construct(string $name, string $contentAttribute)
    {
        parent::__construct([
            'name' => $name,
            'content' => $contentAttribute,
        ]);
    }
}
