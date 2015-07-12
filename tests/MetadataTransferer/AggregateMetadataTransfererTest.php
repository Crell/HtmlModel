<?php

namespace Crell\HtmlModel\Test\MetadataTransferer;

use Crell\HtmlModel\Head\LinkElement;
use Crell\HtmlModel\Head\MetaRefreshElement;
use Crell\HtmlModel\Head\ScriptElement;
use Crell\HtmlModel\Head\StyleElement;
use Crell\HtmlModel\Head\StyleLinkElement;
use Crell\HtmlModel\HtmlFragment;
use Crell\HtmlModel\HtmlPage;
use Crell\HtmlModel\HtmlPageInterface;
use Crell\HtmlModel\MetadataTransfer\AggregateMetadataTransferer;
use Crell\HtmlModel\MetadataTransfer\HeadElementTransferer;
use Crell\HtmlModel\MetadataTransfer\ScriptTransferer;
use Crell\HtmlModel\MetadataTransfer\StatusCodeTransferer;
use Crell\HtmlModel\MetadataTransfer\StyleTransferer;
use Prophecy\Argument;

class AggregateMetadataTransfererTest extends \PHPUnit_Framework_TestCase
{
    public function testAggregateHandoff()
    {
        $sub1 = $this->prophesize('Crell\HtmlModel\MetadataTransfer\StyleTransferer');
        $sub1
          ->transfer(Argument::type('Crell\HtmlModel\StyleContainerInterface'), Argument::type('Crell\HtmlModel\StyleContainerInterface'))
          ->will(function ($args) {
              return new HtmlFragment();
          })
          ->shouldBeCalled();

        $sub2 = $this->prophesize('Crell\HtmlModel\MetadataTransfer\ScriptTransferer');
        $sub2
          ->transfer(Argument::type('Crell\HtmlModel\ScriptContainerInterface'), Argument::type('Crell\HtmlModel\ScriptContainerInterface'))
          ->will(function ($args) {
              return new HtmlFragment();
          })
          ->shouldBeCalled();

        // HtmlFragment doesn't implement StatusCodeContainerInterface, so
        // this transferer should be skipped entirely.
        $sub3 = $this->prophesize('Crell\HtmlModel\MetadataTransfer\StatusCodeTransferer');
        $sub3
          ->transfer(Argument::type('Crell\HtmlModel\StatusCodeContainerInterface'), Argument::type('Crell\HtmlModel\StatusCodeContainerInterface'))
          ->shouldNotBeCalled();

        $src = new HtmlFragment();

        /** @var HtmlFragment $src */
        $src = $src
          ->withScript(new ScriptElement('header.js'))
          ->withScript(new ScriptElement('footer.js'), 'footer')
          ->withStyleLink(new StyleLinkElement('css.css'))
          ->withInlineStyle(new StyleElement('CSS here'))
        ;

        $dest = new HtmlFragment();

        $transferer = new AggregateMetadataTransferer([
          'Crell\HtmlModel\StyleContainerInterface' => $sub1->reveal(),
          'Crell\HtmlModel\ScriptContainerInterface' => $sub2->reveal(),
          'Crell\HtmlModel\StatusCodeContainerInterface' => $sub3->reveal(),
        ]);

        // The mocks above will ensure that everything gets called that should
        // get called.
        $transferer->transfer($src, $dest);
    }


    public function testDifferentDestinationClass()
    {
        $src = new HtmlFragment();

        $inline_script = new ScriptElement();
        $inline_script = $inline_script->withContent('Some JS here');

        /** @var HtmlFragment $src */
        $src = $src
          ->withHeadElement(new MetaRefreshElement(3, 'http://www.google.com'))
          ->withHeadElement(new LinkElement('canonical', 'http://www.example.com/'))
          ->withScript(new ScriptElement('js.js'))
          ->withScript(new ScriptElement('footer.js'), 'footer')
          ->withScript($inline_script)
          ->withStyleLink(new StyleLinkElement('css.css'))
          ->withInlineStyle(new StyleElement('CSS here'))
          ->withContent('Body here')
        ;

        $dest = new HtmlPage();

        $transferer = new AggregateMetadataTransferer([
          'Crell\HtmlModel\StyleContainerInterface' => new StyleTransferer(),
          'Crell\HtmlModel\ScriptContainerInterface' => new ScriptTransferer(),
          'Crell\HtmlModel\StatusCodeContainerInterface' => new StatusCodeTransferer(),
          'Crell\HtmlModel\HeadElementContainerInterface' => new HeadElementTransferer(),
        ]);

        /** @var HtmlPageInterface $html */
        $html = $transferer->transfer($src, $dest);
        $this->assertInstanceOf('Crell\HtmlModel\HtmlPage', $html);

        // Check links.
        $links = $html->getLinks();
        $this->assertCount(2, $links);
        $this->assertInstanceOf('\Crell\HtmlModel\Head\StyleLinkElement', $links[0]);
        $this->assertInstanceOf('\Crell\HtmlModel\Head\LinkElement', $links[1]);

        // Check Head elements generally.
        $head_elements = $html->getHeadElements();
        $this->assertCount(2, $head_elements);
        $this->assertInstanceOf('\Crell\HtmlModel\Head\MetaElement', $head_elements[0]);
        $this->assertEquals('3;url=http://www.google.com', $head_elements[0]->getAttribute('content'));
        $this->assertInstanceOf('\Crell\HtmlModel\Head\LinkElement', $head_elements[1]);
        $this->assertEquals('canonical', $head_elements[1]->getRel());
        $this->assertEquals('http://www.example.com/', $head_elements[1]->getHref());

        // Check Inline styles.
        $inline_styles = $html->getInlineStyles();
        $this->assertCount(1, $inline_styles);
        $this->assertEquals('CSS here', $inline_styles[0]->getContent());

        // Check Style Links.
        $style_links = $html->getStyleLinks();
        $this->assertCount(1, $style_links);
        $this->assertEquals('css.css', $style_links[0]->getAttribute('href'));

        // Check scripts.
        $scripts = $html->getScripts();
        $this->assertCount(2, $scripts);
        $this->assertEquals('js.js', $scripts[0]->getAttribute('src'));
        $this->assertEquals('Some JS here', $scripts[1]->getContent());
        $scripts = $html->getScripts('footer');
        $this->assertCount(1, $scripts);
        $this->assertEquals('footer.js', $scripts[0]->getAttribute('src'));
    }
}
