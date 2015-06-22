<?php
/**
 * Created by PhpStorm.
 * User: crell
 * Date: 6/21/15
 * Time: 11:13 PM
 */

namespace Crell\HtmlModel;

/**
 * Classes with this interface can contain content.
 *
 * @todo There's a fancy name in the spec for such elements; reame this interface
 * accordingly once we look it up.
 */
interface ContentElementInterface {

    /**
     * Returns the body of the element.
     *
     * @return string
     *   The body of the element.
     */
    public function getContent();

    /**
     * Returns a copy of the element with the body content set.
     *
     * @param string $content
     *   The body of the element to set, that is, everything inside the tag.
     * @return self
     */
    public function withContent($content);

}