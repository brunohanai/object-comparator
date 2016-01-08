<?php

namespace brunohanai\ObjectComparator\Differ;

class DiffCollection
{
    const KEY = 'diff_collection';
    const EXTRAS_KEY = 'extras';
    const DIFFS_KEY = 'diffs';

    private $extras;
    private $diffs;

    public function __construct($extras = array())
    {
        $this->extras = new \ArrayIterator($extras);
        $this->diffs = new \ArrayIterator();
    }

    public function getArrayCopy()
    {
        $array = array(
            self::KEY => array(
                self::EXTRAS_KEY => $this->extras->getArrayCopy(),
                self::DIFFS_KEY => array(),
            ),
        );

        $diffs = array();

        /** @var $diff Diff */
        foreach($this->diffs as $diff) {
            $diffs[] = $diff->getArrayCopy();
        }

        $array[self::KEY][self::DIFFS_KEY] = $diffs;

        return $array;
    }

    public function printAsJson()
    {
        return json_encode($this->getArrayCopy());
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