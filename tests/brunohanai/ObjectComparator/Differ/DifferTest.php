<?php

namespace brunohanai\ObjectComparator\Differ;

use brunohanai\ObjectComparator\Comparator;

class DifferTest extends \PHPUnit_Framework_TestCase
{
    /** @var Differ */
    private $differ;

    public function setUp()
    {
        $this->differ = new Differ(new Comparator());
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

    public function testDiff_withoutChanges_shouldReturnDiffCollectionWithNothing()
    {
        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);

        $diffCollection = $this->differ->diff($empresa1, $empresa2);

        $this->assertEquals(0, $diffCollection->getDiffs()->count());
    }

    public function testDiff_withChanges_shouldReturnDiffCollection()
    {
        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna Tech', 'HTC', 10001);

        $diffCollection = $this->differ->diff($empresa1, $empresa2);

        $this->assertEquals(2, $diffCollection->getDiffs()->count());
    }

    /**
     * @expectedException brunohanai\ObjectComparator\Exceptions\ObjectsNotValidForComparisonException
     */
    public function testDiff_withInvalidObjects1_shouldThrowAnException()
    {
        $empresa = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);

        $this->differ->diff('ab', $empresa);
    }

    /**
     * @expectedException brunohanai\ObjectComparator\Exceptions\ObjectsNotValidForComparisonException
     */
    public function testDiff_withInvalidObjects2_shouldThrowAnException()
    {
        $empresa = $this->createEmpresa(2, 'Hosanna', 'HOS', 10001);

        $this->differ->diff($empresa, 'ab');
    }
}