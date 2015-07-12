<?php

namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\StyleElement;

class StyleElementTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $style = new StyleElement('CSS goes here');

        $this->assertEquals('CSS goes here', $style->getContent());
    }

    public function testExtraAttributes()
    {
        $style = new StyleElement('CSS goes here');

        $style2 = $style
            ->withAttribute('type', 'text/scss')
            ->withAttribute('media', 'print')
            ->withAttribute('disabled', true)
            ->withContent('SCSS goes here');

        $this->assertEquals('text/scss', $style2->getAttribute('type'));
        $this->assertEquals('print', $style2->getAttribute('media'));
        $this->assertEquals(true, $style2->getAttribute('disabled'));
        $this->assertEquals('SCSS goes here', $style2->getContent());
    }

    public function testRender()
    {
        $style = new StyleElement('CSS goes here');

        $rendered = "<style type=\"text/css\">\nCSS goes here\n</style>";

        $this->assertEquals($rendered, (string)$style);
    }
}
