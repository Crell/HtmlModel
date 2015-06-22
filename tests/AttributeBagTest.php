<?php

namespace Crell\HtmlModel\Test;


use Crell\HtmlModel\AttributeBag;

class AttributeBagTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Confirms that setting values from the constructor works.
     */
    public function testConstructorDefaults()
    {
        $bag = new AttributeBag([
            'foo' => 'bar',
            'baz' => 'beep',
        ]);

        $this->assertCount(2, $bag);
        $this->assertEquals('bar', $bag->get('foo'));
        $this->assertEquals('beep', $bag->get('baz'));
    }

    /**
     * Confirms that a bag stringifies properly if attributes were set from the constructor.
     */
    public function testStringifyFromConstructor()
    {
        $bag = new AttributeBag([
          'normal' => 'value',
          'empty' => '',
          'forreals' => true,
          'nope' => false,
          'list' => ['a', 'b', 'c']
        ]);

        $expected = " normal=\"value\" forreals list=\"a b c\"";
        $this->assertEquals($expected, (string)$bag);
    }

    /**
     * Confirms that a bag stringifies properly if attributes were set with methods.
     */
    public function testStringifyFromMethods()
    {
        $bag = new AttributeBag();

        // Note that the order the attributes are set determines the render order.
        $bag = $bag
          ->withAttribute('normal', 'value')
          ->withAttribute('forreals', true)
          ->withAttribute('list', ['a','b', 'c'])
          ->withAttribute('empty', '')
          ->withAttribute('nope', false);

        $expected = " normal=\"value\" forreals list=\"a b c\"";
        $this->assertEquals($expected, (string)$bag);
    }

    /**
     * Confirms that a bag stringifies in the order of its constructor.
     */
    public function testStringifyAttributeOrder()
    {
        $bag = new AttributeBag([
          'normal' => 'value',
          'empty' => '',
          'forreals' => true,
          'nope' => false,
          'list' => ['a', 'b', 'c']
        ]);

        // Note this order is different than the constructor order, but constructor
        // order should win.
        $bag = $bag
          ->withAttribute('list', ['a','b', 'c'])
          ->withAttribute('forreals', true)
          ->withAttribute('empty', '')
          ->withAttribute('nope', false)
         ->withAttribute('normal', 'value');

        $expected = " normal=\"value\" forreals list=\"a b c\"";
        $this->assertEquals($expected, (string)$bag);
    }

    /**
     * Confirms that only whitelisted attributes are allowed.
     *
     * @expectedException \InvalidArgumentException
     */
    public function testSetDisallowedAttribute()
    {
        $bag = new AttributeBag([
            'sample' => '',
        ]);

        $bag = $bag->withAttribute('notWhiteListed', 'value');
    }

    /**
     * Confirms that whitelisted attributes can be set via a method.
     */
    public function testSetAllowedAttribute()
    {
        $bag = new AttributeBag([
          'sample' => '',
        ]);

        $bag2 = $bag->withAttribute('sample', 'value');

        $this->assertCount(1, $bag2);
        $this->assertEquals('value', $bag2->get('sample'));
    }

    public function testRemoveAllowedAttribute()
    {
        $bag = new AttributeBag([
          'sample' => 'value',
        ]);

        $bag2 = $bag->remove('sample');

        $this->assertTrue($bag2->has('sample'));
        $this->assertFalse($bag2->get('sample'));
        $this->assertEquals('value', $bag->get('sample'));
    }

    /**
     * Confirms that removing an invalid attribute silently works.
     */
    public function testRemoveDisallowedAttribute()
    {
        $bag = new AttributeBag([
          'sample' => '',
        ]);

        // This should throw no error.
        $bag2 = $bag->remove('nyet');

        $this->assertFalse($bag2->has('nyet'));
    }
}
