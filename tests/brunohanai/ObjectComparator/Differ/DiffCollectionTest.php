<?php

namespace brunohanai\ObjectComparator\Differ;

class DiffCollectionTest extends \PHPUnit_Framework_TestCase
{
    /** @var DiffCollection */
    private $defaultCollection;
    /** @var DiffCollection */
    private $nullCollection;
    private $object;
    private $property;
    private $value1_1;
    private $value1_2;
    private $value2_1;
    private $value2_2;

    public function setUp()
    {
        $this->object = 'EmpresaConf';
        $this->property = 'descricao';
        $this->value1_1 = 'v1.1';
        $this->value1_2 = 'v1.2';

        $this->value2_1 = 'v2.1';
        $this->value2_2 = 'v2.2';

        $this->defaultCollection = new DiffCollection();
        $this->defaultCollection->addDiff(new Diff($this->object, $this->property, $this->value1_1, $this->value1_2));
        $this->defaultCollection->addDiff(new Diff($this->object, $this->property, $this->value2_1, $this->value2_2));

        $this->nullCollection = new DiffCollection();
    }

    public function testAddDiff()
    {
        $diffCollection = new DiffCollection();

        $diff = new Diff('object', 'property', 'key1', 'value1');
        $diffCollection->addDiff($diff);

        $this->assertEquals(1, $diffCollection->getDiffs()->count());

        $diffCollection->getDiffs()->rewind();
        $this->assertEquals(get_class($diff), get_class($diffCollection->getDiffs()->current()));
    }

    public function testGetArrayCopy_notUsingSlimVersion_shouldReturnCompleteArray()
    {
        $expectedArray = array(
            DiffCollection::KEY => array(
                DiffCollection::DIFFS_KEY => array(
                    array(
                        Diff::KEY => array(
                            Diff::OBJECT_KEY => $this->object,
                            Diff::PROPERTY_KEY => $this->property,
                            Diff::VALUES_KEY => array(
                                Diff::VALUE_1_KEY => $this->value1_1,
                                Diff::VALUE_2_KEY => $this->value1_2,
                            ),
                        ),
                    ),
                    array(
                        Diff::KEY => array(
                            Diff::OBJECT_KEY => $this->object,
                            Diff::PROPERTY_KEY => $this->property,
                            Diff::VALUES_KEY => array(
                                Diff::VALUE_1_KEY => $this->value2_1,
                                Diff::VALUE_2_KEY => $this->value2_2,
                            ),
                        ),
                    ),
                ),
            ),
        );

        $this->assertEquals($expectedArray, $this->defaultCollection->getArrayCopy());
    }

    public function testGetArrayCopy_usingSlimVersion_shouldReturnSimpleArray()
    {
        $expectedArray = array(
            array($this->object.Diff::SEPARATOR.$this->property => array($this->value1_1, $this->value1_2)),
            array($this->object.Diff::SEPARATOR.$this->property => array($this->value2_1, $this->value2_2)),
        );

        $this->assertEquals($expectedArray, $this->defaultCollection->getArrayCopy(true));
    }

    public function testPrintAsJson_notUsingSlimVersion_shouldReturnCompleteJson()
    {
        $expectedJson = sprintf(
            '{"%s":{"%s":[{"%s":{"%s":"%s","%s":"%s","%s":{"%s":"%s","%s":"%s"}}},{"%s":{"%s":"%s","%s":"%s","%s":{"%s":"%s","%s":"%s"}}}]}}',
            DiffCollection::KEY, DiffCollection::DIFFS_KEY,
            Diff::KEY, Diff::OBJECT_KEY, $this->object, Diff::PROPERTY_KEY, $this->property,
            Diff::VALUES_KEY, Diff::VALUE_1_KEY, $this->value1_1, Diff::VALUE_2_KEY, $this->value1_2,
            Diff::KEY, Diff::OBJECT_KEY, $this->object, Diff::PROPERTY_KEY, $this->property,
            Diff::VALUES_KEY, Diff::VALUE_1_KEY, $this->value2_1, Diff::VALUE_2_KEY, $this->value2_2
        );

        $this->assertEquals($expectedJson, $this->defaultCollection->printAsJson());
    }

    public function testPrintAsJson_withoutDiffs_notUsingSlimVersion_shouldReturnJsonWithNull()
    {
        $expectedJson = sprintf('{"%s":{"%s":null}}',
            DiffCollection::KEY, DiffCollection::DIFFS_KEY
        );

        $this->assertEquals($expectedJson, $this->nullCollection->printAsJson());
    }

    public function testPrintAsJson_withoutDiffs_usingSlimVersion_shouldReturnJsonWithNull()
    {
        $expectedJson = 'null';

        $this->assertEquals($expectedJson, $this->nullCollection->printAsJson(true));
    }
}