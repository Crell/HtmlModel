<?php

namespace Crell\HtmlModel\Test\Link;

use Fig\Link\Link;

class LinkTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $link = new Link('canonical', 'http://www.example.com/');

        $this->assertEquals(['canonical'], $link->getRels());
        $this->assertEquals('http://www.example.com/', $link->getHref());
    }

    public function testModifiers()
    {
        $link = new Link('canonical', 'http://www.example.com/');

        /** @var Link $link */
        $link = $link
          ->withRel('up')
          ->withoutRel('canonical')
          ->withHref('http://www.google.com/')
          ->withAttribute('title', 'Search me');

        $this->assertEquals(['up'], $link->getRels());
        $this->assertEquals('http://www.google.com/', $link->getHref());
        $this->assertEquals('Search me', $link->getAttributes()['title']);
    }
}
