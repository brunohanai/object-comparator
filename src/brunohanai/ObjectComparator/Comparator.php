<?php

namespace brunohanai\ObjectComparator;

class Comparator
{
    public function compare($object_1, $object_2)
    {
        $array_1 = (array)$object_1;
        $array_2 = (array)$object_2;

        $comparison = array_diff_assoc($array_1, $array_2);

        if (count($comparison) > 0) {
            return false;
        }

        return true;
    }

    public function isEquals($object_1, $object_2)
    {
        return $this->compare($object_1, $object_2);
    }

    public function isNotEquals($object_1, $object_2)
    {
        return !$this->compare($object_1, $object_2);
    }

    public function valida()
    {
//        if (!is_object($object_1) || !is_object($object_2)) {
//            throw new \Exception('ObjectComparator: $object_1 e $object_2 precisam ser objetos.');
//        }
//
//        if (get_class($object_1) != get_class($object_2)) {
//            throw new \Exception(sprintf(
//                'ObjectComparator: A classe do $object_1(%s) não é igual ao $object_2(%s)', get_class($object_1), get_class($object_2)
//            ));
//        }
    }
}