<?php

namespace Crell\HtmlModel\MetadataTransfer;


use Crell\HtmlModel\HeadElementContainerInterface;

class HeadElementTransferer implements MetadataTransfererInterface
{
    /**
     * {@inheritdoc}
     */
    public function transfer($src, $dest)
    {
        assert('$src instanceof \Crell\HtmlModel\HeadElementContainerInterface');
        assert('$dest instanceof \Crell\HtmlModel\HeadElementContainerInterface');

        /** @var HeadElementContainerInterface $src */
        /** @var HeadElementContainerInterface $dest */

        foreach ($src->getHeadElements() as $element) {
            $dest = $dest->withHeadElement($element);
        }

        return $dest;
    }
}