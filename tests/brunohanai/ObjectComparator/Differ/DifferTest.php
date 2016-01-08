<?php

namespace brunohanai\ObjectComparator\Differ;

class DifferTest extends \PHPUnit_Framework_TestCase
{
    protected function createEmpresa($id = null, $descricao = null, $venture = null, $owner = null)
    {
        $empresa = new \stdClass();
        $empresa->id = $id;
        $empresa->descricao = $descricao;
        $empresa->venture = $venture;
        $empresa->owner = $owner;

        return $empresa;
    }

    public function testDiff()
    {
        $differ = new Differ();

        $empresa1 = $this->createEmpresa(1, 'Hosanna', 'HOS', 10001);
        $empresa2 = $this->createEmpresa(1, 'Hosanna Tecnologia', 'HTC', 10001);

        $extras = array(
            'tabela' => 'easy_call_empresa_conf',
            'user' => 20002,
            'datetime' => (new \DateTime('now'))->format('Y-m-d H:i:s'),
        );

        $diffs = $differ->diff($empresa1, $empresa2, $extras);

        $this->assertEquals(2, $diffs->getDiffs()->count());

        var_dump($diffs->getArrayCopy());
        echo $diffs->printAsJson();
    }
}