<?php

namespace brunohanai\ObjectComparator;

class ComparatorTest extends \PHPUnit_Framework_TestCase
{
    private $comparator;

    public function setUp()
    {
        $this->comparator = new Comparator();
    }

    protected function createEmpresa($id = null, $descricao = null, $venture = null, $owner = null)
    {
        $empresa = new \stdClass();
        $empresa->id = $id;
        $empresa->descricao = $descricao;
        $empresa->venture = $venture;
        $empresa->owner = $owner;

        return $empresa;
    }

    public function testCompareWithEquals_shouldReturnTrue()
    {
        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);

        $this->assertTrue($this->comparator->compare($empresa1, $empresa2));
    }

    public function testCompareWithDifferentObjects_shouldReturnFalse()
    {
        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna Tecnologia', 'HTC', 10001);

        $this->assertFalse($this->comparator->compare($empresa1, $empresa2));
    }

    public function testIsEqualsWithEquals_shouldReturnTrue()
    {
        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);

        $this->assertTrue($this->comparator->isEquals($empresa1, $empresa2));
    }

    public function testIsEqualsWithNotEquals_shouldReturnTrue()
    {
        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna Tecnologia', 'HTC', 10001);

        $this->assertFalse($this->comparator->isEquals($empresa1, $empresa2));
    }

    public function testIsNotEqualsWithEquals_shouldReturnFalse()
    {
        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);

        $this->assertFalse($this->comparator->isNotEquals($empresa1, $empresa2));
    }

    public function testIsNotEqualsWithNotEquals_shouldReturnTrue()
    {
        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna Tecnologia', 'HTC', 10001);

        $this->assertTrue($this->comparator->isNotEquals($empresa1, $empresa2));
    }
}