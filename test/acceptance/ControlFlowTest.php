<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

class ControlFlowTest extends AcceptTestCase
{
    public function testWhenWithTrueFirstARgumentEvalutesSecondArgument()
    {
        $result = $this->execute('(when true 1)');
        $this->assertEquals(1, $result);
    }

    public function testWhenWithFalseFirstARgumentDoesNotEvaluateSecond()
    {
        $result = $this->execute('(when false 1)');
        $this->assertNull($result);
    }

    public function testIfWithTrueFirstArgumentEvaluatesAndReturnsSecondArgument()
    {
        $result = $this->execute('(if true 1 2)');
        $this->assertEquals(1, $result);
    }

    public function testIfWithFalseFirstArgumentsEvalutesAndReturnsThirdArgument()
    {
        $result = $this->execute('(if false 1 2)');
        $this->assertEquals(2, $result);
    }

    public function nots()
    {
        return [
            ['not'],
            ['!'],
        ];
    }

    /**
     * @dataProvider nots
     */
    public function testNotNegatesTheValueOfItsFirstArgument($not)
    {
        $result = $this->execute("({$not} true)");
        $this->assertFalse($result);
    }
}
