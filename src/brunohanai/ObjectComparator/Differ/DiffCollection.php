<?php

namespace brunohanai\ObjectComparator\Differ;

class DiffCollection
{
    private $extras;
    private $diffs;

    public function __construct($extras = array())
    {
        $this->extras = new \ArrayIterator($extras);
        $this->diffs = new \ArrayIterator();
    }

    public function addExtra($key, $value)
    {
        $this->extras->offsetSet($key, $value);

        return $this;
    }

    public function getExtra($key)
    {
        if ($this->extras->offsetExists($key) === false) {
            return null;
        }

        return $this->extras->offsetGet($key);
    }

    public function getExtras()
    {
        return $this->extras;
    }

    public function addDiff(Diff $diff)
    {
        $this->diffs->append($diff);

        return $this;
    }

    public function getDiffs()
    {
        return $this->diffs;
    }
}