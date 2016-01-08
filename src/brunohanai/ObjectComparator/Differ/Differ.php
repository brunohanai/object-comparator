<?php

namespace brunohanai\ObjectComparator\Differ;

class Differ
{
    public function diff($object_1, $object_2)
    {
        $diffs = new DiffCollection();
        $diffs->addExtra(DiffCollection::EXTRA_DEFAULT_OBJECT, get_class($object_1));
        $diffs->addExtra(DiffCollection::EXTRA_DEFAULT_DATETIME, date('Y-m-d H:i:s'));

        $array_1 = (array)$object_1;
        $array_2 = (array)$object_2;

        $comparison = array_diff_assoc($array_1, $array_2);

        foreach($comparison as $key => $value) {
            $diff = new Diff(
                $this->clearKey($object_1, $key),
                $value,
                $array_2[$key]
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