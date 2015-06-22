<?php

namespace Crell\HtmlModel\Test\Head;


use Crell\HtmlModel\Head\MetaElement;

class MetaElementTest extends \PHPUnit_Framework_TestCase {

    public function testConstructor()
    {
        $meta = new MetaElement('content here', [
            'http-equiv' => 'test',
        ]);

        $this->assertEquals('content here', $meta->getAttribute('content'));
        $this->assertEquals('test', $meta->getAttribute('http-equiv'));
    }
}
