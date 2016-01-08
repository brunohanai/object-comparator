<?php

namespace brunohanai\ObjectComparator\Logger;

use brunohanai\ObjectComparator\Differ\DiffCollection;
use Psr\Log\LogLevel;

interface ILogger
{
    public function log(DiffCollection $diffs, $level = LogLevel::DEBUG);
}