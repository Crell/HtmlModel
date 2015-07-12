<?php

namespace Crell\HtmlModel\Test\MetadataTransferer;

use Crell\HtmlModel\HtmlPage;
use Crell\HtmlModel\MetadataTransfer\StatusCodeTransferer;

class StatusCodeTransfererTest extends \PHPUnit_Framework_TestCase
{
    public function testTransferStyles()
    {
        // We're using HtmlPage here rather than the trait because
        // the transferers use assertions to verify the interface, and PHPUnit's
        // Trait mocking can't handle adding interfaces.  Since we know
        // HtmlPage uses the same traits, this is a good enough test.
        $src = new HtmlPage();
        $dest = new HtmlPage();

        $src = $src
          ->withStatusCode(418);

        $transferer = new StatusCodeTransferer();

        /** @var HtmlPage $dest */
        $dest = $transferer->transfer($src, $dest);

        $this->assertEquals(418, $dest->getStatusCode());
    }
}
