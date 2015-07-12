<?php

namespace Crell\HtmlModel\Test\MetadataTransferer;

use Crell\HtmlModel\Head\StyleElement;
use Crell\HtmlModel\Head\StyleLinkElement;
use Crell\HtmlModel\HtmlFragment;
use Crell\HtmlModel\MetadataTransfer\StyleTransferer;

class StyleTransfererTest extends \PHPUnit_Framework_TestCase
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
          ->withStyleLink(new StyleLinkElement('css.css'))
          ->withInlineStyle(new StyleElement('CSS here'))
        ;

        $transferer = new StyleTransferer();

        $dest = $transferer->transfer($src, $dest);

        $inline_styles = $dest->getInlineStyles();
        $this->assertCount(1, $inline_styles);
        $this->assertEquals('CSS here', $inline_styles[0]->getContent());
        $style_links = $dest->getStyleLinks();
        $this->assertCount(1, $style_links);
        $this->assertEquals('css.css', $style_links[0]->getAttribute('href'));
    }
}
