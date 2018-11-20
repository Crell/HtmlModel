<?php

namespace Crell\HtmlModel\MetadataTransfer;

/**
 * Applies multiple transferers to a set of objects.
 */
class AggregateMetadataTransferer implements MetadataTransfererInterface
{
    private $map = [];

    /**
     * Constructs a new AggregateMetadataTransferer
     *
     * @param iterable $transferers
     *   An associative array, where the keys are class/interface names
     *   and the values are transferer instances. This array will be mapped
     *   to the addTransferer() method.
     */
    public function __construct(iterable $transferers = [])
    {
        foreach ($transferers as $class => $transferer) {
            $this->addTransferer($class, $transferer);
        }
    }

    /**
     * Adds a transferer to this object's map.
     *
     * When the transfer() method is invoked, every applicable transferer
     * specified here will be called. A transferer is applicable if both
     * the source and destination implement the class/interface specified.
     *
     * @param string $class
     *   A class or interface.
     * @param MetadataTransfererInterface $transferer
     *   The transferer to call.
     *
     * @return static
     */
    public function addTransferer(string $class, MetadataTransfererInterface $transferer)
    {
        $this->map[$class] = $transferer;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
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
