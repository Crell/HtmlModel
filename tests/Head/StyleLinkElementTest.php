<?php

namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\StyleLinkElement;

class StyleLinkElementTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $link = new StyleLinkElement('styles.css');

        $this->assertEquals(['stylesheet'], $link->getRels());
        $this->assertEquals('styles.css', $link->getHref());
    }
}
