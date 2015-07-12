<?php

namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\MetaRefreshElement;

class MetaRefreshElementTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $meta = new MetaRefreshElement(3, 'http://www.google.com/');

        $this->assertEquals('refresh', $meta->getAttribute('http-equiv'));
        $this->assertEquals('3;url=http://www.google.com/', $meta->getAttribute('content'));
    }
}
