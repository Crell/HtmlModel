<?php

namespace Crell\HtmlModel\Head;

use Psr\Link\EvolvableLinkInterface;

class LinkElement extends HeadElement implements EvolvableLinkInterface
{
//    use EvolvableLinkTrait;

    protected $element = 'link';

    public function __construct($rel, $href, array $attributes = [])
    {
        parent::__construct();

        // @see https://developer.mozilla.org/en-US/docs/Web/HTML/Element/link
        // for a full description of all attributes.
        $defaults = [
          'rel' => [$rel],
          'href' => $href,
          'title' => '',       // Title string, usually used to describe an alternate stylesheet link.
          'hreflang' => '',    // This attribute indicates the language of the linked resource. It is purely advisory.
          'crossorigin' => '', // Indicates if the fetching of the related image must be done using CORS or not. Legal values are "anonymous" and "use-credentials".
          'media' => '',       // This attribute specifies the media which the linked resource applies to. Its value must be a media query.
          'sizes' => '',       // This attribute defines the sizes of the icons for visual media contained in the resource. It must be present only if the rel contains the icon link types value.
          'type' => '',        // This attribute is used to define the type of the content linked to. The value of the attribute should be a MIME type.
        ];

        $attributes += $defaults;

        $this->setAttributes($attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function getHref()
    {
        return $this->getAttribute('href');
    }

    /**
     * {@inheritdoc}
     */
    public function getRels()
    {
        return $this->getAttribute('rel');
    }

    /**
     * {@inheritdoc}
     */
    public function withHref($href)
    {
        return $this->withAttribute('href', $href);
    }

    /**
     * {@inheritdoc}
     */
    public function withRel($rel)
    {
        return $this->withAttribute('rel', array_merge($this->getAttribute('rel'), [$rel]));
    }

    /**
     * {@inheritdoc}
     */
    public function withoutRel($rel)
    {
        $rels = $this->getAttribute('rel');
        $rels = array_diff($rels, [$rel]);
        return $this->withAttribute('rel', $rels);
    }

    /**
     * {@inheritdoc}
     */
    public function isTemplated()
    {
        // HTML links are never templated.
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function withAttribute($key, $value)
    {
        if ($key == 'crossorigin') {
            assert('in_array($value, [\'anonymous\', \'use-credentials\'])');
        }

        return parent::withAttribute($key, $value);
    }
}
