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

    }
}