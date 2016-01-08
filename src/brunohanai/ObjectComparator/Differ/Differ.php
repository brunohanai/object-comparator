<?php

namespace brunohanai\ObjectComparator\Differ;

class Differ
{
    public function diff($object_1, $object_2, $extras = array())
    {
        $array_1 = (array)$object_1;
        $array_2 = (array)$object_2;

        $diffs = new DiffCollection($extras);

        $comparison = array_diff_assoc($array_1, $array_2);

        foreach($comparison as $key => $value) {
            $diff = new Diff(
                $this->clearKey($object_1, $key),
                $value,
                $array_1[$key]
            );

            $diffs->addDiff($diff);
        }

        return $diffs;
    }

    public function clearKey($object, $key)
    {
        /*
         * Exemplo:
         * - de:   CallEmpresaConfAutoactive
         * - para: active (com trim())
         */
        return trim(str_replace(sprintf('%sAuto', get_class($object)), '', $key));
    }
}