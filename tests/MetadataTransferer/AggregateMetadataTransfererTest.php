<?php

namespace Crell\HtmlModel\Test\MetadataTransferer;

use Crell\HtmlModel\Head\ScriptElement;
use Crell\HtmlModel\Head\StyleElement;
use Crell\HtmlModel\Head\StyleLinkElement;
use Crell\HtmlModel\HtmlFragment;
use Crell\HtmlModel\MetadataTransfer\AggregateMetadataTransferer;
use Crell\HtmlModel\ScriptContainerInterface;
use Crell\HtmlModel\StyleContainerInterface;
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

}
