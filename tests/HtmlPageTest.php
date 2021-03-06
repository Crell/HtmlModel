<?php

namespace Crell\HtmlModel\Test;

use Crell\HtmlModel\Head\BaseElement;
use Crell\HtmlModel\Head\LinkElement;
use Crell\HtmlModel\Head\MetaRefreshElement;
use Crell\HtmlModel\Head\ScriptElement;
use Crell\HtmlModel\Head\StyleElement;
use Crell\HtmlModel\Head\StyleLinkElement;
use Crell\HtmlModel\HtmlPage;
use PHPUnit\Framework\TestCase;

class HtmlPageTest extends TestCase
{
    public function testConstructorContent()
    {
        $html = new HtmlPage('Content goes here', 'My title');
        $this->assertEquals('Content goes here', $html->getContent());
        $this->assertEquals('My title', $html->getTitle());
    }

    public function testMethodContent()
    {
        $html = new HtmlPage('Content goes here');
        /** @var HtmlPage $html2 */
        $html2 = $html->withContent('New stuff')->withTitle('New title');
        $this->assertEquals('New stuff', $html2->getContent());
        $this->assertEquals('New title', $html2->getTitle());
    }

    public function testBodyAttributes()
    {
        $html = new HtmlPage();
        $html = $html->withBodyAttribute('foo', 'bar');
        $attributes = $html->getBodyAttributes();

        $attributes->has('foo');
        $this->assertTrue($attributes->has('foo'));
        $this->assertCount(1, $attributes);
        $this->assertEquals('bar', $attributes->get('foo'));
    }

    public function testHtmlAttributes()
    {
        $html = new HtmlPage();
        $html = $html->withHtmlAttribute('foo', 'bar');
        $attributes = $html->getHtmlAttributes();

        $attributes->has('foo');
        $this->assertTrue($attributes->has('foo'));
        $this->assertCount(1, $attributes);
        $this->assertEquals('bar', $attributes->get('foo'));
    }

    public function testTitle()
    {
        $html = new HtmlPage();
        $html = $html
          ->withTitle('Test page');

        $this->assertEquals('Test page', $html->getTitle());
    }

    /**
     * @doesNotPerformAssertions
     */
    public function testAddingEverything()
    {
        $html = new HtmlPage();

        $html = $html
            ->withTitle('Test page')
            ->withBase(new BaseElement('http://www.example.com/'))
            ->withHeadElement(new MetaRefreshElement(3, 'http://www.google.com'))
            ->withHeadElement(new LinkElement('canonical', 'http://www.example.com/'))
            ->withScript(new ScriptElement('js.js'))
            ->withStyleLink(new StyleLinkElement('css.css'))
            ->withInlineStyle(new StyleElement('CSS here'))
            ->withContent('Body here')
        ;
    }

    public function testBase()
    {
        $html = new HtmlPage();
        $html = $html->withBase(new BaseElement('http://www.example.com/'));
        $this->assertEquals('http://www.example.com/', $html->getBase()->getAttribute('href'));

        $html = $html->withoutBase();
        $this->assertNull($html->getBase());
    }

    public function testScripts()
    {
        $html = new HtmlPage();

        $inline_script = new ScriptElement();
        $inline_script = $inline_script->withContent('Some JS here');

        /** @var HtmlPage $html */
        $html = $html
          ->withScript(new ScriptElement('js.js'))
          ->withScript(new ScriptElement('footer.js'), 'footer')
          ->withScript($inline_script);

        $scripts = $html->getScripts();
        $this->assertCount(2, $scripts);
        $this->assertEquals('js.js', $scripts[0]->getAttribute('src'));
        $this->assertEquals('Some JS here', $scripts[1]->getContent());
        $scripts = $html->getScripts('footer');
        $this->assertCount(1, $scripts);
        $this->assertEquals('footer.js', $scripts[0]->getAttribute('src'));
    }

    public function testStyleLinks()
    {
        $html = new HtmlPage();

        /** @var HtmlPage $html */
        $html = $html
          ->withStyleLink(new StyleLinkElement('css.css'))
        ;

        $style_links = $html->getStyleLinks();
        $this->assertCount(1, $style_links);
        $this->assertEquals('css.css', $style_links[0]->getAttribute('href'));
    }

    public function testInlineStyles()
    {
        $html = new HtmlPage();

        /** @var HtmlPage $html */
        $html = $html
          ->withInlineStyle(new StyleElement('CSS here'))
        ;

        $inline_styles = $html->getInlineStyles();
        $this->assertCount(1, $inline_styles);
        $this->assertEquals('CSS here', $inline_styles[0]->getContent());
    }

    public function testHeadElements()
    {
        $html = new HtmlPage();

        /** @var HtmlPage $html */
        $html = $html
          ->withHeadElement(new MetaRefreshElement(3, 'http://www.google.com'))
          ->withHeadElement(new LinkElement('canonical', 'http://www.example.com/'))
        ;

        $head_elements = $html->getHeadElements();
        $this->assertCount(2, $head_elements);
        $this->assertInstanceOf('\Crell\HtmlModel\Head\MetaElement', $head_elements[0]);
        $this->assertEquals('3;url=http://www.google.com', $head_elements[0]->getAttribute('content'));
        $this->assertInstanceOf('\Crell\HtmlModel\Head\LinkElement', $head_elements[1]);
        $this->assertEquals(['canonical'], $head_elements[1]->getRels());
        $this->assertEquals('http://www.example.com/', $head_elements[1]->getHref());
    }

    public function testLinks()
    {
        $html = new HtmlPage();

        /** @var HtmlPage $html */
        $html = $html
          ->withHeadElement(new MetaRefreshElement(3, 'http://www.google.com'))
          ->withHeadElement(new LinkElement('canonical', 'http://www.example.com/'))
          ->withStyleLink(new StyleLinkElement('css.css'))
        ;

        $links = $html->getLinks();
        $this->assertCount(2, $links);
        $this->assertInstanceOf('\Crell\HtmlModel\Head\StyleLinkElement', $links[0]);
        $this->assertInstanceOf('\Crell\HtmlModel\Head\LinkElement', $links[1]);
    }

    public function testRender()
    {
        $html = new HtmlPage();

        /** @var HtmlPage $html */
        $html = $html
          ->withTitle('Test page')
          ->withHtmlAttribute('manifest', 'example.appcache')
          ->withBodyAttribute('foo', 'bar')
          ->withBase(new BaseElement('http://www.example.com/'))
          ->withHeadElement(new MetaRefreshElement(3, 'http://www.google.com'))
          ->withHeadElement(new LinkElement('canonical', 'http://www.example.com/'))
          ->withScript(new ScriptElement('header.js'))
          ->withScript(new ScriptElement('footer.js'), 'footer')
          ->withStyleLink(new StyleLinkElement('css.css'))
          ->withInlineStyle(new StyleElement('CSS here'))
          ->withContent('Body here')
        ;

        $this->assertEquals('Test page', $html->getTitle());

        $expected = <<<END
<html manifest="example.appcache">
<head>
<title>Test page</title>
<base href="http://www.example.com/" />
<meta http-equiv="refresh" content="3;url=http://www.google.com" />
<link rel="canonical" href="http://www.example.com/" />
<link type="text/css" rel="stylesheet" href="css.css" />
<style type="text/css">
CSS here
</style>
<script src="header.js" type="application/javascript" />
</head>
<body>
Body here
<script src="footer.js" type="application/javascript" />
</body>
</html>
END;

        $this->assertEquals($expected, (string)$html);

        // @todo Flesh this out to use SimpleXML and XPath for tests
        // rather than a big fragile string.

        /** @var \SimpleXmlElement $xml */
        $xml = simplexml_load_string($html);
        $this->assertEquals('html', $xml->getName());
    }
}
