<?php

namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\LinkElement;

class LinkElementTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $link = new LinkElement('up', 'http://www.example.com/');

        $this->assertEquals(['up'], $link->getRels());
        $this->assertEquals('http://www.example.com/', $link->getHref());
    }

    public function testCrossOrigin()
    {
        $link = new LinkElement('up', 'http://www.example.com/');
        $link = $link->withAttribute('crossorigin', 'anonymous');

        $this->assertEquals(['up'], $link->getRels());
        $this->assertEquals('http://www.example.com/', $link->getHref());
        $this->assertEquals('anonymous', $link->getAttribute('crossorigin'));

        // @todo Figure out a good way to test the assertion enforcement on
        // crossorigin.
    }
}
