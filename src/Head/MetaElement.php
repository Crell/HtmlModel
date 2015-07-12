<?php

namespace Crell\HtmlModel\Head;

/**
 * Value object representing a meta tag.
 *
 * This class will rarely be instantiated directly. Generally a subclass
 * relevant to a particular use case.
 *
 * @see MetaRefreshElement
 * @see MetaCharsetElement
 * @see NamedMetaElement
 */
class MetaElement extends HeadElement
{
    protected $element = 'meta';

    /**
     * Creates a new MetaElement.
     *
     * @param array $attributes
     *   An array of other attributes to include.
     */
    public function __construct(array $attributes = [])
    {
        if (!empty($attributes['http-equiv'])) {
            assert('$this->validateHttpEquiv($attributes[\'http-equiv\'])');
        }

        // @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/meta
        // for a full description of all attributes.
        $defaults = [
            'name' => '',      // This attribute defines the name of document-level metadata. It should not be set if one of the attributes itemprop, http-equiv or charset is also set.
            'charset' => '',   // This attribute declares the character encoding used of the page. Is a literal string and must be one of the preferred MIME name for a character encoding
            'content' => '',   // This attribute gives the value associated with the http-equiv or name attribute, depending of the context.
            'http-equiv' => '' // This enumerated attribute defines the pragma that can alter servers and user-agents behavior.

        ];

        $attributes += $defaults;

        $this->setAttributes($attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function withAttribute($key, $value)
    {
        if ($key == 'http-equiv') {
            assert('$this->validateHttpEquiv($value)');
        }

        return parent::withAttribute($key, $value);
    }

    /**
     * Validates that an http-equiv value is legal per spec.
     *
     * This method is intended to be called only from assertions.
     *
     * @param string $value
     *   The would-be value of the http-equiv attribute.
     * @return bool
     *   True if the http-equiv value is legal, false otherwise.
     */
    protected function validateHttpEquiv($value)
    {
        return in_array($value, ['Content-Security-Policy', 'default-style', 'refresh']);
    }
}
