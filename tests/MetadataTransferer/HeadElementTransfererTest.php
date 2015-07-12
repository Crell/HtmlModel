<?php

namespace Crell\HtmlModel\Test\MetadataTransferer;

use Crell\HtmlModel\Head\LinkElement;
use Crell\HtmlModel\Head\MetaRefreshElement;
use Crell\HtmlModel\HtmlFragment;
use Crell\HtmlModel\MetadataTransfer\HeadElementTransferer;

class HeadElementTransfererTest extends \PHPUnit_Framework_TestCase
{
    public function testTransferStyles()
    {
        // We're using HtmlFragment here rather than the trait because
        // the transferers use assertions to verify the interface, and PHPUnit's
        // Trait mocking can't handle adding interfaces.  Since we know
        // HtmlFragment uses the same traits, this is a good enough test.
        $src = new HtmlFragment();
        $dest = new HtmlFragment();

        $src = $src
          ->withHeadElement(new MetaRefreshElement(3, 'http://www.google.com'))
          ->withHeadElement(new LinkElement('canonical', 'http://www.example.com/'))
        ;

        $transferer = new HeadElementTransferer();

        $dest = $transferer->transfer($src, $dest);

        $head_elements = $dest->getHeadElements();
        $this->assertCount(2, $head_elements);
        $this->assertInstanceOf('\Crell\HtmlModel\Head\MetaElement', $head_elements[0]);
        $this->assertEquals('3;url=http://www.google.com', $head_elements[0]->getAttribute('content'));
        $this->assertInstanceOf('\Crell\HtmlModel\Head\LinkElement', $head_elements[1]);
        $this->assertEquals('canonical', $head_elements[1]->getRel());
        $this->assertEquals('http://www.example.com/', $head_elements[1]->getHref());
    }
}
