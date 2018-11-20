<?php

namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\StyleLinkElement;
use PHPUnit\Framework\TestCase;

class StyleLinkElementTest extends TestCase
{
    public function testConstructor()
    {
        $link = new StyleLinkElement('styles.css');

        $this->assertEquals(['stylesheet'], $link->getRels());
        $this->assertEquals('styles.css', $link->getHref());
    }
}
