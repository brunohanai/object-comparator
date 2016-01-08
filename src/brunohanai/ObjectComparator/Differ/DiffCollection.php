<?php

namespace brunohanai\ObjectComparator\Differ;

class DiffCollection
{
    const KEY = 'diff_collection';
    const DIFFS_KEY = 'diffs';

    private $diffs;

    public function __construct()
    {
        $this->diffs = new \ArrayIterator();
    }

    public function getArrayCopy($slim_version = false)
    {
        $diffs = array();

        /** @var $diff Diff */
        foreach($this->diffs as $diff) {
            $diffs[] = $diff->getArrayCopy($slim_version);
        }

        if ($slim_version === false) {
            return array(
                self::KEY => array(
                    self::DIFFS_KEY => $diffs
                )
            );
        }

        return $diffs;
    }

    public function printAsJson($slim_version = false)
    {
        return json_encode($this->getArrayCopy($slim_version));
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