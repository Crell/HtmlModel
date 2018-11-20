<?php

namespace Crell\HtmlModel\Head;

use Crell\HtmlModel\ContentElementInterface;
use Crell\HtmlModel\ContentElementTrait;

class ScriptElement extends HeadElement implements ContentElementInterface
{
    use ContentElementTrait;

    protected $element = 'script';

    /**
     * Constructs a new ScriptElement.
     *
     * @param string $src
     *   The URI of an external script.
     */
    public function __construct(string $src = '')
    {
        $this->setAttributes([
            'src' => $src,                      // The URI of an external script.
            'type' => 'application/javascript', // Mime type, identifies the scripting language of code embedded within a script element.
            'defer' => false,                   // Boolean. If True, indicates to a browser that the script is meant to be executed after the document has been parsed.
            'async' => false,                   // Boolean. If True, indicates that the browser should, if possible, execute the script asynchronously.
        ]);
    }
}
