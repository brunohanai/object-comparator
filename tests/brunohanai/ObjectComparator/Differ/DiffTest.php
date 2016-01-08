<?php

namespace brunohanai\ObjectComparator\Differ;

class DiffTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor_shouldSetProperties()
    {
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff('EmpresaConf', $property, $value1, $value2);

        $this->assertEquals($property, $diff->getProperty());
        $this->assertEquals($value1, $diff->getValue1());
        $this->assertEquals($value2, $diff->getValue2());
    }

    public function testGetArrayCopy_notUsingSlimVersion_shouldReturnCompleteArray()
    {
        $object = 'EmpresaConf';
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff($object, $property, $value1, $value2);

        $expectedArray = array(
            Diff::KEY => array(
                Diff::OBJECT_KEY => $object,
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
        $object = 'EmpresaConf';
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff($object, $property, $value1, $value2);

        $expectedArray = array($object.Diff::SEPARATOR.$property => array($value1, $value2));
        $this->assertEquals($expectedArray, $diff->getArrayCopy(true));
    }

    public function testPrintAsJson_notUsingSlimVersion_shouldReturnCompleteJson()
    {
        $object = 'EmpresaConf';
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff($object, $property, $value1, $value2);

        $expectedJson = sprintf(
            '{"%s":{"%s":"%s","%s":"%s","%s":{"%s":"%s","%s":"%s"}}}',
            Diff::KEY, Diff::OBJECT_KEY, $object, Diff::PROPERTY_KEY, $property,
            Diff::VALUES_KEY, Diff::VALUE_1_KEY, $value1, Diff::VALUE_2_KEY, $value2
        );

        $this->assertEquals($expectedJson, $diff->printAsJson());
    }

    public function testPrintAsJson_usingSlimVersion_shouldReturnSimpleJson()
    {
        $object = 'EmpresaConf';
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff($object, $property, $value1, $value2);

        $expectedJson = sprintf('{"%s%s%s":["%s","%s"]}', $object, Diff::SEPARATOR, $property, $value1, $value2);

        $this->assertEquals($expectedJson, $diff->printAsJson(true));
    }
}