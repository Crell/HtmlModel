<?php

namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\MetaElement;

class MetaElementTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $meta = new MetaElement([
            'content' => 'content here',
            'http-equiv' => 'refresh',
        ]);

        $this->assertEquals('content here', $meta->getAttribute('content'));
        $this->assertEquals('refresh', $meta->getAttribute('http-equiv'));
    }

    public function testHttpEquiv()
    {
        $meta = new MetaElement();

        /** @var MetaElement $meta */
        $meta = $meta
          ->withAttribute('http-equiv', 'refresh')
          ->withAttribute('content', '3;url=http://www.google.com');

        $this->assertEquals('3;url=http://www.google.com', $meta->getAttribute('content'));
        $this->assertEquals('refresh', $meta->getAttribute('http-equiv'));
    }
}
