<?php

namespace Crell\HtmlModel\Test;


use Crell\HtmlModel\Head\BaseElement;
use Crell\HtmlModel\Head\LinkElement;
use Crell\HtmlModel\Head\MetaElement;
use Crell\HtmlModel\Head\ScriptElement;
use Crell\HtmlModel\Head\StyleElement;
use Crell\HtmlModel\Head\StyleLinkElement;
use Crell\HtmlModel\HtmlPage;

class HtmlPageTest extends \PHPUnit_Framework_TestCase
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

    public function testSomething()
    {
        $html = new HtmlPage();

        $html = $html
            ->withTitle('Test page')
            ->withBase(new BaseElement('http://www.example.com/'))
            ->withHeadElement(new MetaElement('foo'))
            ->withHeadElement(new LinkElement('canonical', 'http://www.example.com/'))
            ->withScript(new ScriptElement('js.js'))
            ->withStyleLink(new StyleLinkElement('css.js'))
            ->withInlineStyle(new StyleElement('CSS here'))
            ->withContent('Body here')
        ;

    }
}
