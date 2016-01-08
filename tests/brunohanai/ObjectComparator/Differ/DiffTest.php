<?php

namespace brunohanai\ObjectComparator\Differ;

class DiffTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor_shouldSetProperties()
    {
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff($property, $value1, $value2);

        $this->assertEquals($property, $diff->getProperty());
        $this->assertEquals($value1, $diff->getValue1());
        $this->assertEquals($value2, $diff->getValue2());
    }

    public function testGetArrayCopy_notUsingSlimVersion_shouldReturnCompleteArray()
    {
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff($property, $value1, $value2);

        $expectedArray = array(
            Diff::KEY => array(
                Diff::PROPERTY_KEY => $property,
                Diff::VALUES_KEY => array(
                    Diff::VALUE_1_KEY => $value1,
                    Diff::VALUE_2_KEY => $value2,
                ),
            ),
        );
        $this->assertEquals($expectedArray, $diff->getArrayCopy());
    }

    public function testGetArrayCopy_usingSlimVersion_shouldReturnSimpleArray()
    {
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff($property, $value1, $value2);

        $expectedArray = array($property => array($value1, $value2));
        $this->assertEquals($expectedArray, $diff->getArrayCopy(true));
    }

    public function testPrintAsJson_notUsingSlimVersion_shouldReturnCompleteJson()
    {
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff($property, $value1, $value2);

        $expectedJson = sprintf(
            '{"%s":{"%s":"%s","%s":{"%s":"%s","%s":"%s"}}}',
            Diff::KEY, Diff::PROPERTY_KEY, $property,
            Diff::VALUES_KEY, Diff::VALUE_1_KEY, $value1, Diff::VALUE_2_KEY, $value2
        );

        $this->assertEquals($expectedJson, $diff->printAsJson());
    }

    public function testPrintAsJson_usingSlimVersion_shouldReturnSimpleJson()
    {
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff($property, $value1, $value2);

        $expectedJson = sprintf('{"%s":["%s","%s"]}', $property, $value1, $value2);

        $this->assertEquals($expectedJson, $diff->printAsJson(true));
    }
}