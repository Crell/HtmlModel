<?php

namespace Crell\HtmlModel;

use Crell\HtmlModel\Head\HeadElement;
use Crell\HtmlModel\Link\Linkable;
use Crell\HtmlModel\Link\LinkInterface;

class HtmlFragment implements HtmlFragmentInterface, Linkable
{
    use ContentElementTrait;
    use StyleContainerTrait;
    use ScriptContainerTrait;
    use HeadElementContainerTrait;

    /**
     * {@inheritdoc}
     */
    public function getLinks()
    {
        return array_merge($this->getStyleLinks(), array_filter($this->getHeadElements(), function(HeadElement $element) {
            return $element instanceof LinkInterface;
        }));
    }

}
