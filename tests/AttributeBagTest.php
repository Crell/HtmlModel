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
        ]);

        $expected = " normal=\"value\" forreals";
        $this->assertEquals($expected, (string)$bag);
    }

    /**
     * Confirms that a bag stringifies properly if attributes were set with methods.
     */
    public function testStringifyFromMethods()
    {
        $bag = new AttributeBag();

        $bag = $bag->withAttribute('normal', 'value')
            ->withAttribute('empty', '')
            ->withAttribute('forreals', true)
            ->withAttribute('nope', false);

        $expected = " normal=\"value\" forreals";
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
}
