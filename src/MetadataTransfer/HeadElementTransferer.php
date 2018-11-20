<?php

namespace Crell\HtmlModel\MetadataTransfer;

use Crell\HtmlModel\HeadElementContainerInterface;

/**
 * Transferer for HeadElement objects.
 */
class HeadElementTransferer implements MetadataTransfererInterface
{
    /**
     * {@inheritdoc}
     */
    public function transfer($src, $dest)
    {
        assert($src instanceof HeadElementContainerInterface);
        assert($dest instanceof HeadElementContainerInterface);

        /** @var HeadElementContainerInterface $src */
        /** @var HeadElementContainerInterface $dest */

        foreach ($src->getHeadElements() as $element) {
            $dest = $dest->withHeadElement($element);
        }

        return $dest;
    }
}
