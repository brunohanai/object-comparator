<?php

namespace brunohanai\ObjectComparator\Differ;

use brunohanai\ObjectComparator\Comparator;
use brunohanai\ObjectComparator\Exceptions\ObjectsNotValidForComparisonException;

class Differ
{
    private $comparator;

    public function __construct(Comparator $comparator)
    {
        $this->comparator = $comparator;
    }

    public function diff($object_1, $object_2)
    {
        if ($this->comparator->isValidForComparison($object_1, $object_2) === false) {
            throw new ObjectsNotValidForComparisonException();
        };

        $diffs = new DiffCollection();

        $array_1 = (array)$object_1;
        $array_2 = (array)$object_2;


        $comparison = array_diff_assoc($array_1, $array_2);

        foreach($comparison as $key => $value) {
            $diffs->addDiff(new Diff(
                get_class($object_1),
                $this->clearKey($object_1, $key),
                $value,
                $array_2[$key]
            ));
        }

        return $diffs;
    }

    protected function clearKey($object, $key)
    {
        /*
         * Exemplo:
         * - de:   CallEmpresaConfAutoactive
         * - para: active (com trim())
         */
        return trim(str_replace(sprintf('%sAuto', get_class($object)), '', $key));
    }
}