<?php

namespace Crell\HtmlModel\MetadataTransfer;


use Crell\HtmlModel\StatusCodeContainerInterface;

/**
 * Transferer for objects that track a status code.
 */
class StatusCodeTransferer implements MetadataTransfererInterface
{
    /**
     * {@inheritdoc}
     */
    public function transfer($src, $dest)
    {
        assert('$src instanceof \Crell\HtmlModel\StatusCodeContainerInterface');
        assert('$dest instanceof \Crell\HtmlModel\StatusCodeContainerInterface');

        /** @var StatusCodeContainerInterface $src */
        /** @var StatusCodeContainerInterface $dest */

        return $dest->withStatusCode($src->getStatusCode());
    }
}
