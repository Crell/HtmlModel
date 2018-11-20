<?php

namespace Crell\HtmlModel\Test;

use Crell\HtmlModel\StatusCodeContainerTrait;
use PHPUnit\Framework\TestCase;

class StatusCodeContainerTraitTest extends TestCase
{
    public function testStatusCode()
    {
        /** @var StatusCodeContainerTrait $status */
        $status = $this->getObjectForTrait('\Crell\HtmlModel\StatusCodeContainerTrait');

        $status = $status->withStatusCode(418);
        $this->assertEquals(418, $status->getStatusCode());
    }

    public function testStatusCodeNoOp()
    {
        /** @var StatusCodeContainerTrait $status */
        $status = $this->getObjectForTrait('\Crell\HtmlModel\StatusCodeContainerTrait');

        $status = $status->withStatusCode(418);

        $status2 = $status->withStatusCode(418);
        $this->assertEquals(418, $status2->getStatusCode());
        $this->assertSame($status, $status2);
    }
}
