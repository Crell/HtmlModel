<?php

namespace Crell\HtmlModel\Test\Head;


use Crell\HtmlModel\Head\HeadElement;

class HeadElementTest extends \PHPUnit_Framework_TestCase
{

    public function testAttributes()
    {
        $head = new HeadElement();

        $head2 = $head->withAttribute('foo', 'bar');
        $head3 = $head->withAttribute('foo', 'bar');

        $this->assertEquals('bar', $head2->getAttribute('foo'));
        $this->assertEquals('bar', $head3->getAttribute('foo'));
    }
}
