<?php

namespace Crell\HtmlModel\Test;

use Crell\HtmlModel\StyleElement;

class HeadElementTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test that true does in fact equal true
     */
    public function testStleElementDefaults()
    {
        $style = new StyleElement('CSS goes here');

        $this->assertContains('text/css', $style->getAttributes());
    }
}
