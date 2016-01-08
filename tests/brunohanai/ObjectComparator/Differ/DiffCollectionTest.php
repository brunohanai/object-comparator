<?php

namespace brunohanai\ObjectComparator\Differ;

class DiffCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testAddExtra()
    {
        $diffCollection = new DiffCollection();
        $diffCollection->addExtra('key1', 'value1');
        $diffCollection->addExtra('key2', 'value2');

        $this->assertEquals($diffCollection->getExtra('key1'), 'value1');
        $this->assertEquals($diffCollection->getExtra('key2'), 'value2');
        $this->assertEquals(2, $diffCollection->getExtras()->count());
    }

    public function testAddDiff()
    {
        $diffCollection = new DiffCollection();

        $diff = new Diff('property', 'key1', 'value1');
        $diffCollection->addDiff($diff);

        $this->assertEquals(1, $diffCollection->getDiffs()->count());

        $diffCollection->getDiffs()->rewind();
        $this->assertEquals(get_class($diff), get_class($diffCollection->getDiffs()->current()));

    }
}