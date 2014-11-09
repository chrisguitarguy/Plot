<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

class MathTest extends AcceptTestCase
{
    public function testAdditionProducesCorrectSum()
    {
        $this->assertEquals(15, $this->execute('(+ 5 5 5)'));
    }

    public function testSubtractionProducesCorrectDifference()
    {
        $this->assertEquals(20, $this->execute('(- 35 5 10)'));
    }

    public function testMultiplicationProducesCorrectProduct()
    {
        $this->assertEquals(8, $this->execute('(* 2 2 2)'));
    }

    public function testDivisionProducesCorrectQuotient()
    {
        $this->assertEquals(5, $this->execute('(/ 50 2 5)'));
    }

    public function testModuloProducesCorrectRemainder()
    {
        $this->assertEquals(1, $this->execute('(% 10 3 2)'));
    }

    public static function ops()
    {
        return [
            ['+'],
            ['-'],
            ['*'],
            ['/'],
            ['%'],
        ];
    }

    /**
     * @dataProvider ops
     * @expectedException Chrisguitarguy\Plot\Exception\BadCallException
     */
    public function testMathOperationWithNonNumericValueCausesError($op)
    {
        $this->execute("({$op} 'nope')");
    }
}
