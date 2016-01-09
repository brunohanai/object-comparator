<?php

namespace brunohanai\ObjectComparator\Differ\Logger;

use brunohanai\ObjectComparator\Differ\DiffCollection;
use Psr\Log\LogLevel;

class DefaultLogger implements ILogger
{
    public function log(DiffCollection $diffs, $slim_version = false, $level = LogLevel::DEBUG)
    {
        error_log($diffs->printAsJson($slim_version));
    }
}