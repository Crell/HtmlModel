<?php

namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\ScriptElement;
use PHPUnit\Framework\TestCase;

class ScriptElementTest extends TestCase
{
    public function testConstrutor()
    {
        $script = new ScriptElement('js.js');

        $this->assertEquals('js.js', $script->getAttribute('src'));
    }


    public function testRender()
    {
        $script = new ScriptElement();
        $script = $script->withContent('JS goes here');

        $expected = "<script type=\"application/javascript\">\nJS goes here\n</script>";

        $this->assertEquals($expected, (string)$script);
    }
}
