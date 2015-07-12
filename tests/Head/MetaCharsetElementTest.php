<?php

namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\MetaCharsetElement;

class MetaCharsetElementTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $meta = new MetaCharsetElement();

        $this->assertEquals('UTF-8', $meta->getAttribute('charset'));
    }
}
