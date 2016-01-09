<?php

namespace brunohanai\ObjectComparator;

use brunohanai\ObjectComparator\Exceptions\ObjectsNotValidForComparisonException;

class Comparator
{
    public function isEquals($object_1, $object_2)
    {
        return $this->compare($object_1, $object_2);
    }

    public function isNotEquals($object_1, $object_2)
    {
        return !$this->compare($object_1, $object_2);
    }

    protected function compare($object_1, $object_2)
    {
        if ($this->isValidForComparison($object_1, $object_2) === false) {
            throw new ObjectsNotValidForComparisonException();
        };

        $array_1 = (array)$object_1;
        $array_2 = (array)$object_2;

        $comparison = array_diff_assoc($array_1, $array_2);

        if (count($comparison) > 0) {
            return false;
        }

        return true;
    }

    public function isValidForComparison($object_1, $object_2)
    {
        if (!is_object($object_1)) {
            return false;
        }

        if (!is_object($object_2)) {
            return false;
        }

        if (get_class($object_1) != get_class($object_2)) {
            return false;
        }

        return true;
    }
}