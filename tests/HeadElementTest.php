<?php

namespace Crell\HtmlModel\Test;

use Crell\HtmlModel\Head\LinkElement;
use Crell\HtmlModel\Head\StyleElement;

class HeadElementTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that true does in fact equal true
     */
    public function testStyleElementDefaults()
    {
        $style = new StyleElement('CSS goes here');

        $this->assertContains('text/css', $style->getAttributes());
    }

    public function testStyleElementRender()
    {
        $style = new StyleElement('CSS goes here');

        $rendered = "<style type=\"text/css\">\nCSS goes here\n</style>";

        $this->assertEquals($rendered, (string)$style);
    }

    public function testLinkElement()
    {
        $link = new LinkElement('self', 'http://www.google.com/');

        $rendered = "<link rel=\"self\" href=\"http://www.google.com/\" />";

        $this->assertEquals($rendered, (string)$link);
    }
}
