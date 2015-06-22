<?php

namespace Crell\HtmlModel\Test\Head;


use Crell\HtmlModel\Head\LinkElement;

class LinkElementTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $link = new LinkElement('up', 'http://www.example.com/');

        $this->assertEquals('up', $link->getRel());
        $this->assertEquals('http://www.example.com/', $link->getHref());
    }
}
