<?php

namespace brunohanai\ObjectComparator\Differ\Logger;

use Mockery;

class DefaultLoggerTest extends \PHPUnit_Framework_TestCase
{
    public function testLog_shouldCallTheLogMethod()
    {
        $logger = new DefaultLogger();

        $diffCollection = Mockery::mock('brunohanai\ObjectComparator\Differ\DiffCollection');
        $diffCollection->shouldReceive('printAsJson')->once();

        $logger->log($diffCollection);
    }
}