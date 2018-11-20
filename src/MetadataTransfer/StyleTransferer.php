<?php

namespace Crell\HtmlModel\MetadataTransfer;

use Crell\HtmlModel\StyleContainerInterface;

/**
 * Transferer for StyleElement objects.
 */
class StyleTransferer implements MetadataTransfererInterface
{
    /**
     * {@inheritdoc}
     */
    public function transfer($src, $dest)
    {
        assert($src instanceof StyleContainerInterface);
        assert($dest instanceof StyleContainerInterface);

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
