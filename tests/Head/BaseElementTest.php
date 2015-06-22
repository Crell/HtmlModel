<?php

namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\BaseElement;

class BaseElementTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $base = new BaseElement('http://www.example.com/', '_blank');

        $this->assertEquals('http://www.example.com/', $base->getAttribute('href'));
        $this->assertEquals('_blank', $base->getAttribute('target'));
    }

    public function testMethods()
    {
        $base = new BaseElement('http://www.example.com/');

        // Note the order is not the same as the constructor, to verify that doesn't matter.
        $base2 = $base
          ->withAttribute('target', '_blank')
          ->withAttribute('href', 'http://www.example2.com/');

        $this->assertEquals('http://www.example2.com/', $base2->getAttribute('href'));
        $this->assertEquals('_blank', $base2->getAttribute('target'));
    }

}
