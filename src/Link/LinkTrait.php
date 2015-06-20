<?php

namespace Crell\HtmlModel\Link;

/**
 * Common implementation of LinkInterface.
 */
trait LinkTrait
{

    /**
     * @var string
     */
    private $href = '';

    /**
     * @var string
     */
    private $rel = '';

    /**
     * @var string[]
     */
    private $attributes = [];

    /**
     * Returns the target of the link.
     *
     * The target must be a URI or a Relative URI reference.
     *
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * Returns the relationship type(s) of the link.
     *
     * This method returns 0 or more relationship types for a link, expressed
     * as an array of strings.
     *
     * The returned values should be either a simple keyword or an absolute
     * URI. In case a simple keyword is used, it should match one from the
     * IANA registry at:
     *
     * http://www.iana.org/assignments/link-relations/link-relations.xhtml
     *
     * Optionally the microformats.org registry may be used, but this may not
     * be valid in every context:
     *
     * http://microformats.org/wiki/existing-rel-values
     *
     * Private relationship types should always be an absolute URI.
     *
     * @return string[]
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * Returns a list of attributes that describe the target URI.
     *
     * The list should be specified as a key-value list.
     *
     * There is no formal registry of the values that are allowed here, and
     * validity of values is depdendent on context.
     *
     * Common values are 'hreflang', 'title', and 'type'. Implementors
     * embedding a serialized version of a link are responsible for only
     * encoding the values they support.
     *
     * Any value that appears that is not valid in the context in which it is
     * used should be ignored.
     *
     * Some attributes, (commonly hreflang) may appear more than once in their
     * context. Attributes such as those may be specified as an array of
     * strings.
     *
     * @return array
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

}