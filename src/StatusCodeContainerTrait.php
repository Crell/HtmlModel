<?php

namespace Crell\HtmlModel;

/**
 * Common implementation of StatusCodeContainerInterface.
 */
trait StatusCodeContainerTrait
{
    /**
     * The HTTP status code of this page.
     *
     * @var int
     */
    private $statusCode = 200;

    /**
     * Returns the status code of this response.
     *
     * @return int
     *   The status code of this page.
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Returns a copy of the page with the status code set.
     *
     * @param int $code
     *   The status code to set.
     * @return static
     */
    public function withStatusCode($code)
    {
        if ($this->statusCode == $code) {
            return $this;
        }

        $that = clone($this);
        $that->statusCode = $code;
        return $that;
    }
}
