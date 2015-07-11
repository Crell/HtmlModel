<?php

namespace Crell\HtmlModel\Head;

class MetaElement extends HeadElement
{
    protected $element = 'meta';

    /**
     * Creates a new MetaElement.
     *
     * @param string $contentAttribute
     *   The value of the "content" attribute.
     * @param array $attributes
     *   An array of other attributes to include.
     */
    public function __construct($contentAttribute, array $attributes = [])
    {
        // @todo Add the rest of the legal meta attributes.
        // @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meta
        $attributes['content'] = $contentAttribute;

        $this->setAttributes($attributes);
    }
}
