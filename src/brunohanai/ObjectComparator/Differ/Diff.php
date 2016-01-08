<?php

namespace brunohanai\ObjectComparator\Differ;

class Diff
{
    const KEY = 'diff';
    const PROPERTY_KEY = 'property';
    const CHANGE_KEY = 'change';
    const VALUE_1_KEY = 'value1';
    const VALUE_2_KEY = 'value2';

    private $property;
    private $value1;
    private $value2;

    public function __construct($property, $value_1, $value_2)
    {
        $this->property = $property;
        $this->value1 = $value_1;
        $this->value2 = $value_2;
    }

    public function getArrayCopy()
    {
        $array = array(
            self::KEY => array(
                self::PROPERTY_KEY => $this->property, self::CHANGE_KEY => array(
                    self::VALUE_1_KEY => $this->value1,
                    self::VALUE_2_KEY => $this->value2,
                )
            )
        );

        return $array;
    }

    public function printAsJson()
    {
        return json_encode($this->getArrayCopy());
    }

    /**
     * @return mixed
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @return mixed
     */
    public function getValue1()
    {
        return $this->value1;
    }

    /**
     * @return mixed
     */
    public function getValue2()
    {
        return $this->value2;
    }
}