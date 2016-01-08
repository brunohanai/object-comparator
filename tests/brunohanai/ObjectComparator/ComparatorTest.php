<?php

namespace brunohanai\ObjectComparator;

use brunohanai\ObjectComparator\Exceptions\ObjectsNotValidForComparisonException;

class ComparatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var $comparator Comparator */
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

    /**
     * @expectedException brunohanai\ObjectComparator\Exceptions\ObjectsNotValidForComparisonException
     */
    public function testIsValidForComparison_withDifferentTypeObjects_shouldThrowAnException()
    {
        $empresa = $this->createEmpresa(1);
        $datetime = new \DateTime('now');

        $this->comparator->isEquals($empresa, $datetime);
    }

    /**
     * @expectedException brunohanai\ObjectComparator\Exceptions\ObjectsNotValidForComparisonException
     */
    public function testIsValidForComparison_withFirstParameterIncorrect_shouldThrowAnException()
    {
        $empresa1 = array('a, b, c');
        $empresa2 = $this->createEmpresa(2);

        $this->comparator->isEquals($empresa1, $empresa2);
    }

    /**
     * @expectedException brunohanai\ObjectComparator\Exceptions\ObjectsNotValidForComparisonException
     */
    public function testIsValidForComparison_withSecondParameterIncorrect_shouldThrowAnException()
    {
        $empresa1 = $this->createEmpresa(1);
        $empresa2 = 'objeto2';

        $this->comparator->isEquals($empresa1, $empresa2);
    }

    public function testIsValidForComparison_withEqualTypeObjects_shouldThrowNothing()
    {
        $empresa1 = $this->createEmpresa(1);
        $empresa2 = $this->createEmpresa(2);

        $this->comparator->isEquals($empresa1, $empresa2);
    }

    public function testIsEquals_withEquals_shouldReturnTrue()
    {
        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);

        $this->assertTrue($this->comparator->isEquals($empresa1, $empresa2));
    }

    public function testIsEquals_withNotEquals_shouldReturnFalse()
    {
        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna Tech', 'HTC', 10001);

        $this->assertFalse($this->comparator->isEquals($empresa1, $empresa2));
    }

    public function testIsNotEquals_withEquals_shouldReturnFalse()
    {
        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);

        $this->assertFalse($this->comparator->isNotEquals($empresa1, $empresa2));
    }

    public function testIsNotEquals_withNotEquals_shouldReturnTrue()
    {
        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna Tech', 'HTC', 10001);

        $this->assertTrue($this->comparator->isNotEquals($empresa1, $empresa2));
    }
}