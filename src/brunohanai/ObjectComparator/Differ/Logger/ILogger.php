<?php

namespace brunohanai\ObjectComparator\Differ\Logger;

use brunohanai\ObjectComparator\Differ\DiffCollection;
use Psr\Log\LogLevel;

interface ILogger
{
    public function log(DiffCollection $diffs, $slim_version = false, $level = LogLevel::DEBUG);
}