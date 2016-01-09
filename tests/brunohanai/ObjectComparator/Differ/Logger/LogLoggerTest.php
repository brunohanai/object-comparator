<?php

namespace brunohanai\ObjectComparator\Differ\Logger;

use Mockery;

class LogLoggerTest extends \PHPUnit_Framework_TestCase
{
    public function testLog_shouldCallTheLogMethod()
    {
        $loggerInterface = Mockery::mock('Psr\Log\LoggerInterface');
        $loggerInterface->shouldReceive('log')->once();

        $diffCollection = Mockery::mock('brunohanai\ObjectComparator\Differ\DiffCollection');
        $diffCollection->shouldReceive('printAsJson')->once();

        $logger = new LogLogger($loggerInterface);
        $logger->log($diffCollection);
    }
}