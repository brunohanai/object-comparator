<?php

namespace brunohanai\ObjectComparator\Differ;

class DiffTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff($property, $value1, $value2);

        $this->assertEquals($property, $diff->getProperty());
        $this->assertEquals($value1, $diff->getValue1());
        $this->assertEquals($value2, $diff->getValue2());
    }

    public function testWithCommonValues()
    {
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff($property, $value1, $value2);

        $expected = '{"property":"descricao","change":{"value1":"Hosanna","value2":"Hosanna Tecnologia"}}';

        $this->assertEquals($expected, $diff->printAsJson());
    }

    public function testWithValue1Null()
    {
        $property = 'descricao';
        $value1 = null;
        $value2 = 'Hosanna Tecnologia';

        $diff = new Diff($property, $value1, $value2);

        $expected = '{"property":"descricao","change":{"value1":null,"value2":"Hosanna Tecnologia"}}';

        $this->assertEquals($expected, $diff->printAsJson());
    }

    public function testWithValue2Null()
    {
        $property = 'descricao';
        $value1 = 'Hosanna';
        $value2 = null;

        $diff = new Diff($property, $value1, $value2);

        $expected = '{"property":"descricao","change":{"value1":"Hosanna","value2":null}}';

        $this->assertEquals($expected, $diff->printAsJson());
    }

    public function testWithValue1AndValue2Null()
    {
        $property = 'descricao';
        $value1 = null;
        $value2 = null;

        $diff = new Diff($property, $value1, $value2);

        $expected = '{"property":"descricao","change":{"value1":null,"value2":null}}';

        $this->assertEquals($expected, $diff->printAsJson());
    }
}