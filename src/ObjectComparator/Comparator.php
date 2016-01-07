<?php
namespace brunohanai\ObjectComparator;

class Comparator
{
    private $logger;

//    public function __construct(ILogger $logger)
//    {
//        $this->logger = $logger;
//    }

//    public function diff($old_object, $new_object)
//    {
//        $old = (array)$old_object;
//        $new = (array)$new_object;
//
//        $diffs = new DiffCollection($old_object);
//
//        $comparison = array_diff_assoc($old, $new);
//
//        foreach($comparison as $key => $value) {
//            $diff = new Diff(
//                $this->clearKey($old_object, $key),
//                $value,
//                $new[$key]
//            );
//
//            $diffs->getDiffs()->append($diff);
//        }
//
//        $this->logger->log($diffs);
//    }

    public function clearKey($old_object, $key)
    {
        /*
         * Exemplo:
         * - de:   CallEmpresaConfAutoactive
         * - para: active (com trim())
         */
        return trim(str_replace(sprintf('%sAuto', get_class($old_object)), '', $key));
    }
}