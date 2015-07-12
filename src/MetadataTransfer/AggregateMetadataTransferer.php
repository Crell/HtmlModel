<?php

namespace Crell\HtmlModel\MetadataTransfer;

use Crell\HtmlModel\StyleContainerInterface;

class AggregateMetadataTransferer implements MetadataTransfererInterface
{
    private $map = [];

    public function __construct(array $transferers = [])
    {
        foreach ($transferers as $class => $transferer) {
            $this->addTransferer($class, $transferer);
        }
    }

    public function addTransferer($class, MetadataTransfererInterface $transferer)
    {
        $this->map[$class] = $transferer;

        return $this;
    }

    public function transfer($src, $dest)
    {
        /**
         * @var string $interface
         * @var MetadataTransfererInterface $transferer
         */
        foreach ($this->map as $interface => $transferer) {
            if ($src instanceof $interface && $dest instanceof $interface) {
                $dest = $transferer->transfer($src, $dest);
            }
        }

        return $dest;
    }

}
