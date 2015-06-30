<?php

namespace Crell\HtmlModel\Test;

use Crell\HtmlModel\StatusCodeContainerTrait;

class StatusCodeContainerTraitTest extends \PHPUnit_Framework_TestCase
{

    public function testStatusCode()
    {
        /** @var StatusCodeContainerTrait $status */
        $status = $this->getObjectForTrait(StatusCodeContainerTrait::class);

        $status = $status->withStatusCode(418);
        $this->assertEquals(418, $status->getStatusCode());
    }

    public function testStatusCodeNoOp()
    {
        /** @var StatusCodeContainerTrait $status */
        $status = $this->getObjectForTrait(StatusCodeContainerTrait::class);

        $status = $status->withStatusCode(418);

        $status2 = $status->withStatusCode(418);
        $this->assertEquals(418, $status2->getStatusCode());
        $this->assertSame($status, $status2);
    }
}
