<?php

namespace Crell\HtmlModel\Head;

class KeywordsMetaElement extends NamedMetaElement
{
    /**
     * @param array $keywords
     *   An array of keywords to denote on this
     */
    public function __construct(array $keywords = [])
    {
        parent::__construct('keywords', implode(', ', $keywords));
    }

    /**
     * Returns a new element with the specified keywords added.
     *
     * @param array $keywords
     *   An indexed array of keyword strings to add to this meta element.
     * @return static
     *   A new KeywordsMetaElement instance with the provided keywords added.
     */
    public function withAddedKeywords(array $keywords = []) : self
    {
        $existing = array_map('trim', explode(',', $this->getAttribute('content') ?: ''));
        $new = array_merge($existing, $keywords);

        return $this->withAttribute('content', implode(', ', $new));
    }
}
