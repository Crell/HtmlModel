<?php

namespace Crell\HtmlModel\Test\MetadataTransferer;

use Crell\HtmlModel\HtmlFragment;
use Crell\HtmlModel\Head\ScriptElement;
use Crell\HtmlModel\MetadataTransfer\ScriptTransferer;
use PHPUnit\Framework\TestCase;

class ScriptTransfererTest extends TestCase
{
    public function testTransferScripts()
    {
        // We're using HtmlFragment here rather than the trait because
        // the transferers use assertions to verify the interface, and PHPUnit's
        // Trait mocking can't handle adding interfaces.  Since we know
        // HtmlFragment uses the same traits, this is a good enough test.
        $src = new HtmlFragment();
        $dest = new HtmlFragment();

        $inline_script = new ScriptElement();
        $inline_script = $inline_script->withContent('Some JS here');

        $src = $src
          ->withScript(new ScriptElement('js.js'))
          ->withScript(new ScriptElement('footer.js'), 'footer')
          ->withScript($inline_script);

        $transferer = new ScriptTransferer();

        $dest = $transferer->transfer($src, $dest);

        $scripts = $dest->getScripts();
        $this->assertCount(2, $scripts);
        $this->assertEquals('js.js', $scripts[0]->getAttribute('src'));
        $this->assertEquals('Some JS here', $scripts[1]->getContent());
        $scripts = $dest->getScripts('footer');
        $this->assertCount(1, $scripts);
        $this->assertEquals('footer.js', $scripts[0]->getAttribute('src'));
    }
}
