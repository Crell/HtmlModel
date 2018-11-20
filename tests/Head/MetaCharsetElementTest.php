<?php

namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\MetaCharsetElement;
use PHPUnit\Framework\TestCase;

class MetaCharsetElementTest extends TestCase
{
    public function testConstructor()
    {
        $meta = new MetaCharsetElement();

        $this->assertEquals('UTF-8', $meta->getAttribute('charset'));
    }
}
