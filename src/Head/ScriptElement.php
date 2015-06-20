<?php

namespace Crell\HtmlModel\Head;


class ScriptElement extends HeadElement
{

    protected $element = 'script';

    protected $allowedAttributes = [
        'src',   // The URI of an external script.
        'type',  // Mime type, identifies the scripting language of code embedded within a script element.
        'defer', // Boolean. If True, indicates to a browser that the script is meant to be executed after the document has been parsed.
        'async', // Boolean. If True, indicates that the browser should, if possible, execute the script asynchronously.
    ];

    public function __construct($src)
    {
        $this->setAttribute('src', $src);
        $this->setAttribute('type', 'application/javascript');
    }


}
