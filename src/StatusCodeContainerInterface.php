<?php
/**
 * Created by PhpStorm.
 * User: crell
 * Date: 6/22/15
 * Time: 12:20 AM
 */
namespace Crell\HtmlModel;

interface StatusCodeContainerInterface
{
    /**
     * Returns the status code of this response.
     *
     * @return int
     *   The status code of this page.
     */
    public function getStatusCode();

    /**
     * Returns a copy of the page with the status code set.
     *
     * @param int $code
     *   The status code to set.
     *
     * @return static
     */
    public function withStatusCode($code);
}
