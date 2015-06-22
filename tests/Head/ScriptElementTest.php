<?php

namespace Crell\HtmlModel\Test\Head;


use Crell\HtmlModel\Head\ScriptElement;

class ScriptElementTest extends \PHPUnit_Framework_TestCase
{

    public function testConstrutor()
    {
        $script = new ScriptElement('js.js');

        $this->assertEquals('js.js', $script->getAttribute('src'));
    }
}
