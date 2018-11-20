<?php

namespace Crell\HtmlModel\Head;

class MetaRefreshElement extends MetaElement
{
    /**
     * Constructs a new MetaRefreshElement.
     *
     * @param int $seconds
     *   The number of seconds after which the browser should redirect the user
     *   to the specified URL.
     * @param $url
     *   The URL to which to redirect.
     */
    public function __construct(int $seconds, $url)
    {
        parent::__construct([
            'http-equiv' => 'refresh',
            'content' => "{$seconds};url={$url}",
        ]);
    }
}
