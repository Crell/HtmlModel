<?php
/**
 * Created by PhpStorm.
 * User: crell
 * Date: 6/21/15
 * Time: 9:24 PM
 */

namespace Crell\HtmlModel\Test;


use Crell\HtmlModel\HtmlPage;

class HtmlPageTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorContent()
    {
        $html = new HtmlPage('Content goes here', 'My title');
        $this->assertEquals('Content goes here', $html->getContent());
        $this->assertEquals('My title', $html->getTitle());
    }

    public function testConstructorMethod()
    {
        $html = new HtmlPage('Content goes here');
        $html2 = $html->withContent('New stuff')->withTitle('New title');
        $this->assertEquals('New stuff', $html2->getContent());
        $this->assertEquals('New title', $html2->getTitle());

        //print spl_object_hash($html) . PHP_EOL;
        //print spl_object_hash($html2) . PHP_EOL;

        // It should be a different object, because immutable.
        //$this->assertFalse($html !== $html2);
    }

    public function testSomething()
    {
        $html = new HtmlPage();
        $html2 = $html->withBodyAttribute('foo', 'bar');
        $attributes = $html2->getBodyAttributes();

        $attributes->has('foo');
        $this->assertTrue($attributes->has('foo'));
        $this->assertCount(1, $attributes);
        $this->assertEquals('bar', $attributes->get('foo'));

        // It should be a different object, because immutable.
        //$this->assertFalse($html !== $html2);
    }
}
