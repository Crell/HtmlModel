<?php

namespace Crell\HtmlModel\Test;

use Crell\HtmlModel\Head\LinkElement;
use Crell\HtmlModel\Head\MetaElement;
use Crell\HtmlModel\Head\MetaRefreshElement;
use Crell\HtmlModel\Head\StyleLinkElement;
use Crell\HtmlModel\HtmlFragment;
use PHPUnit\Framework\TestCase;

class HtmlFragmentTest extends TestCase
{
    public function testLinks()
    {
        $fragment = new HtmlFragment();

        /** @var HtmlFragment $fragment */
        $fragment = $fragment
          ->withHeadElement(new MetaRefreshElement(3, 'http://www.google/com'))
          ->withHeadElement(new LinkElement('canonical', 'http://www.example.com/'))
          ->withStyleLink(new StyleLinkElement('css.css'))
        ;

        $links = $fragment->getLinks();
        $this->assertCount(2, $links);
        $this->assertInstanceOf('\Crell\HtmlModel\Head\StyleLinkElement', $links[0]);
        $this->assertInstanceOf('\Crell\HtmlModel\Head\LinkElement', $links[1]);
    }
}
