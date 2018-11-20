<?php

namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\HeadElement;
use PHPUnit\Framework\TestCase;

class HeadElementTest extends TestCase
{
    public function testAttributes()
    {
        $head = new HeadElement();

        $head2 = $head->withAttribute('foo', 'bar');
        $head3 = $head->withoutAttribute('foo');

        $this->assertEquals('bar', $head2->getAttribute('foo'));
        $this->assertEquals('', $head3->getAttribute('foo'));
    }

    public function testNoScript()
    {
        $head = new HeadElement();
        $head2 = $head
            ->withNoScript()
            ->withAttribute('foo', 'bar');

        $expected = '<noscript>< foo="bar" /></noscript>';

        $this->assertEquals($expected, (string)$head2);
    }
}
