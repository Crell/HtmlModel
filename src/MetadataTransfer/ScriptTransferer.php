<?php

namespace Crell\HtmlModel\MetadataTransfer;

use Crell\HtmlModel\ScriptContainerInterface;

class ScriptTransferer implements MetadataTransfererInterface
{
    /**
     * {@inheritdoc}
     */
    public function transfer($src, $dest)
    {
        assert('$src instanceof \Crell\HtmlModel\ScriptContainerInterface');
        assert('$dest instanceof \Crell\HtmlModel\ScriptContainerInterface');

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
