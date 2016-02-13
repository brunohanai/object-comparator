<?php
require '../vendor/autoload.php';

use brunohanai\ObjectComparator\Comparator;

// create a Comparator
$comparator = new Comparator();

// create two identical objects
$object1 = new stdClass();
$object1->description = 'Description';
$object1->code = 'DESC';
// ---
$object2 = new stdClass();
$object2->description = 'Description';
$object2->code = 'DESC';

// check (optional)
var_dump($comparator->isValidForComparison($object1, $object2));

// compare
var_dump($comparator->isEquals($object1, $object2)); // outputs true
var_dump($comparator->isNotEquals($object1, $object2)); // outputs false