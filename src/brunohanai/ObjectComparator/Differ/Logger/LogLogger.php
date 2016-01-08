<?php

namespace brunohanai\ObjectComparator\Differ\Logger;

use brunohanai\ObjectComparator\Differ\DiffCollection;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class LogLogger implements ILogger
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function log(DiffCollection $diffs, $level = LogLevel::DEBUG)
    {
        $this->logger->log($level, $diffs->printAsJson());
    }
}