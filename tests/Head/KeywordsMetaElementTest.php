<?php


namespace Crell\HtmlModel\Test\Head;

use Crell\HtmlModel\Head\KeywordsMetaElement;
use PHPUnit\Framework\TestCase;

class KeywordsMetaElementTest extends TestCase
{
    public function testConstructor()
    {
        $meta = new KeywordsMetaElement(['dopey', 'sneezy']);

        $this->assertEquals('keywords', $meta->getAttribute('name'));
        $this->assertEquals('dopey, sneezy', $meta->getAttribute('content'));
    }

    public function testAddKeywords()
    {
        $meta = new KeywordsMetaElement(['dopey', 'sneezy']);

        $meta = $meta
          ->withAddedKeywords(['grmpyprogrammer', 'doc']);

        $this->assertEquals('keywords', $meta->getAttribute('name'));
        $this->assertEquals('dopey, sneezy, grmpyprogrammer, doc', $meta->getAttribute('content'));
    }
}
