<?php

namespace Crell\HtmlModel\MetadataTransfer;

use Crell\HtmlModel\StyleContainerInterface;

class StyleTransferer implements MetadataTransfererInterface
{
    /**
     * {@inheritdoc}
     */
    public function transfer($src, $dest)
    {
        assert('$src instanceof \Crell\HtmlModel\StyleContainerInterface');
        assert('$dest instanceof \Crell\HtmlModel\StyleContainerInterface');

        /** @var StyleContainerInterface $src */
        /** @var StyleContainerInterface $dest */

        foreach ($src->getInlineStyles() as $element) {
            $dest = $dest->withInlineStyle($element);
        }
        foreach ($src->getStyleLinks() as $element) {
            $dest = $dest->withStyleLink($element);
        }

        return $dest;
    }
}
