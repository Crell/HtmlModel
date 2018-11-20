<?php

namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\MetaRefreshElement;
use PHPUnit\Framework\TestCase;

class MetaRefreshElementTest extends TestCase
{
    public function testConstructor()
    {
        $meta = new MetaRefreshElement(3, 'http://www.google.com/');

        $this->assertEquals('refresh', $meta->getAttribute('http-equiv'));
        $this->assertEquals('3;url=http://www.google.com/', $meta->getAttribute('content'));
    }
}
