<?php
/**
 * Esse arquivo faz parte do projeto ObjectComparator.
 *
 * @author Bruno Hanai
 * @link https://github.com/brunohanai/object-comparator
 *
 */

namespace brunohanai\ObjectComparator;

use brunohanai\ObjectComparator\Exceptions\ObjectsNotValidForComparisonException;

/**
 * Comparador.
 *
 * Fornece métodos para comparação de dois objetos.
 *
 * @api
 *
 * @example examples/example1.php
 *
 */
class Comparator
{
    /**
     * Recebe dois argumentos e compara se são exatamente iguais.
     *
     * @param mixed[]|\stdClass $object_1                  Um objeto ou array com chaves|propriedades e valores que serão comparados com o $object_2.
     * @param mixed[]|\stdClass $object_2                           Um objeto ou array com chaves|propriedades e valores que serão comparados com o $object_1.
     * @throws ObjectsNotValidForComparisonException    Exceção caso os parâmetros sejam inválidos.
     * @return bool
     *
     * @api
     * @version v1.0.0
     * @since   v1.0.0
     *
     * @uses self::compare()
     *
     */
    public function isEquals($object_1, $object_2)
    {
        return $this->compare($object_1, $object_2);
    }

    /**
     * Recebe dois argumentos e compara se são diferentes (qualquer diferença entre eles).
     *
     * @param mixed[]|\stdClass $object_1                           Um objeto ou array com chaves|propriedades e valores que serão comparados com o $object_2.
     * @param mixed[]|\stdClass $object_2                           Um objeto ou array com chaves|propriedades e valores que serão comparados com o $object_1.
     * @throws ObjectsNotValidForComparisonException    Exceção caso os parâmetros sejam inválidos.
     * @return bool
     *
     * @api
     * @version v1.0.0
     * @since   v1.0.0
     *
     * @uses self::compare()
     *
     */
    public function isNotEquals($object_1, $object_2)
    {
        return !$this->compare($object_1, $object_2);
    }

    /**
     * Recebe dois argumentos e os compara.
     *
     * @param mixed[]|\stdClass $object_1                           Um objeto ou array com chaves|propriedades e valores que serão comparados com o $object_2.
     * @param mixed[]|\stdClass $object_2                           Um objeto ou array com chaves|propriedades e valores que serão comparados com o $object_1.
     * @throws ObjectsNotValidForComparisonException    Exceção caso os parâmetros sejam inválidos.
     * @return bool                                     True se os parâmetros forem iguais. False se forem diferentes.
     *
     * @intern
     * @version v1.0.0
     * @since   v1.0.0
     *
     * @uses self::isValidForComparison
     */
    private function compare($object_1, $object_2)
    {
        if ($this->isValidForComparison($object_1, $object_2) === false) {
            throw new ObjectsNotValidForComparisonException();
        };

        $array_1 = (array)$object_1;
        $array_2 = (array)$object_2;

        $comparison = array_diff_assoc($array_1, $array_2);

        if (count($comparison) > 0) {
            return false;
        }

        return true;
    }

    /**
     * Recebe dois argumentos e verifica se são válidos para utilização do método compare.
     *
     * Os argumentos precisam ser do mesmo tipo (stdClass ou array) ou instâncias de uma mesma classe.
     *
     * @param mixed[]|\stdClass $object_1                           Um objeto ou array com chaves|propriedades e valores que serão comparados com o $object_2.
     * @param mixed[]|\stdClass $object_2                           Um objeto ou array com chaves|propriedades e valores que serão comparados com o $object_1.
     * @return bool
     *
     * @api
     * @version v1.0.0
     * @since   v1.0.0
     *
     */
    public function isValidForComparison($object_1, $object_2)
    {
        if (!is_object($object_1)) {
            return false;
        }

        if (!is_object($object_2)) {
            return false;
        }

        if (get_class($object_1) != get_class($object_2)) {
            return false;
        }

        return true;
    }
}