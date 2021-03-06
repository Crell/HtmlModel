<?php

namespace Crell\HtmlModel\MetadataTransfer;

use Crell\HtmlModel\ScriptContainerInterface;

/**
 * Transferer for ScriptElement objects.
 */
class ScriptTransferer implements MetadataTransfererInterface
{
    /**
     * {@inheritdoc}
     */
    public function transfer($src, $dest)
    {
        assert($src instanceof ScriptContainerInterface);
        assert($dest instanceof ScriptContainerInterface);

        /** @var ScriptContainerInterface $src */
        /** @var ScriptContainerInterface $dest */

        foreach (['header', 'footer'] as $scope) {
            foreach ($src->getScripts($scope) as $element) {
                $dest = $dest->withScript($element, $scope);
            }
        }

        return $dest;
    }
}
