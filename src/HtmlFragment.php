<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\HeadElement;
use Fig\Link\EvolvableLinkProviderTrait;
use Psr\Link\EvolvableLinkProviderInterface;
use Psr\Link\LinkInterface;

/**
 * Value object representing a portion of an HTML page.
 *
 * An HtmlFragment is useful to model a subset of a page, such as sidebar
 * elements or similar. The idea is that it can carry not just the string
 * but also associated metadata, like what style elements are necessary for
 * that markup.
 */
class HtmlFragment implements HtmlFragmentInterface, EvolvableLinkProviderInterface
{
    use ContentElementTrait;
    use StyleContainerTrait;
    use ScriptContainerTrait;
    use HeadElementContainerTrait;
    use EvolvableLinkProviderTrait;

    /**
     * {@inheritdoc}
     */
    public function getLinks()
    {
        return array_merge($this->getStyleLinks(), array_filter($this->getHeadElements(), function (HeadElement $element) {
            return $element instanceof LinkInterface;
        }));
    }
}
