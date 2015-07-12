<?php

namespace Crell\HtmlModel\MetadataTransfer;

/**
 * Interface for all metadata transfer objects.
 */
interface MetadataTransfererInterface
{
    /**
     * Transfers metadata from one object to a new instance of the second.
     *
     * It is assumed that $dest is an immutable object, so it is left untouched
     * and a new instance is returned.
     *
     * Nominally, both $src and $dest may be of any type. However, they must
     * implement at least one of the same interface, and that interface must
     * allow for some way to set $src's data on a new instance of $dest.
     *
     * @param mixed $src
     *   Th object from which to transfer metadata. It must not be modified.
     * @param mixed $dest
     *   The object to which to transfer metadata. This object must not be
     *   modified. A new instance will be returned.
     *
     * @return mixed
     *   An instance of the same class as $dest, containing whatever metadata
     *   $dest had as well as what $src had.
     */
    public function transfer($src, $dest);
}
