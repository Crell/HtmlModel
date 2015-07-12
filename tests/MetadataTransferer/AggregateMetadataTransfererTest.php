<?php

namespace Crell\HtmlModel\Test\MetadataTransferer;

use Crell\HtmlModel\Head\LinkElement;
use Crell\HtmlModel\Head\MetaElement;
use Crell\HtmlModel\Head\ScriptElement;
use Crell\HtmlModel\Head\StyleElement;
use Crell\HtmlModel\Head\StyleLinkElement;
use Crell\HtmlModel\HtmlFragment;
use Crell\HtmlModel\MetadataTransfer\AggregateMetadataTransferer;
use Crell\HtmlModel\MetadataTransfer\StyleTransferer;
use Crell\HtmlModel\StyleContainerInterface;
use Crell\HtmlModel\MetadataTransfer\MetadataTransfererInterface;
use Prophecy\Argument;
use Prophecy\Prophecy\MethodProphecy;

class AggregateMetadataTransfererTest extends \PHPUnit_Framework_TestCase
{

    public function testAggregateHandoff()
    {
        $sub1 = $this->prophesize(StyleTransferer::class);
        $sub1
          ->transfer(Argument::type(StyleContainerInterface::class), Argument::type(StyleContainerInterface::class))
          ->will(function ($args) {
            return new HtmlFragment();
          })
          ->shouldBeCalled();

        $src = new HtmlFragment();

        /** @var HtmlFragment $src */
        $src = $src
          //->withScript(new ScriptElement('header.js'))
          //->withScript(new ScriptElement('footer.js'), 'footer')
          ->withStyleLink(new StyleLinkElement('css.css'))
          ->withInlineStyle(new StyleElement('CSS here'))
          //->withContent('Body here')
        ;

        $dest = new HtmlFragment();

        $transferer = new AggregateMetadataTransferer([
          StyleContainerInterface::class => $sub1->reveal(),
        ]);

        // The mocks above will ensure that everything gets called that should
        // get called.
        $transferer->transfer($src, $dest);
    }
}
