<?php

namespace Crell\HtmlModel\Link;

/**
 * Methods to modify LinkInterface objects in an immutable way.
 *
 * @todo Find a better name for this since they're not actually modifiers.
 */
interface ModifiableLinkInterface
{
    /**
     * @param $href
     *
     * @return static
     */
    public function withHref($href);

    /**
     * @param $rel
     *
     * @return static
     */
    public function withRel($rel);

    /**
     * @param string $key
     *   The key of the additional attribute to add.
     * @param string $value
     *
     * @return static
     */
    public function withAttribute($key, $value);
}
