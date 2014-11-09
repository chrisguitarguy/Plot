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

    /**
     * @expectedException Chrisguitarguy\Plot\Exception\BadCallException
     */
    public function testWhenWithToFewArgumentsCausesError()
    {
        $this->execute('(when)');
    }

    /**
     * @expectedException Chrisguitarguy\Plot\Exception\BadCallException
     */
    public function testWhenWithToManyArgumentsCausesError()
    {
        $this->execute('(when true "yep" "yep")');
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

    /**
     * @expectedException Chrisguitarguy\Plot\Exception\BadCallException
     */
    public function testIfWithToFewArgumentsCausesError()
    {
        $this->execute('(if true)');
    }

    /**
     * @expectedException Chrisguitarguy\Plot\Exception\BadCallException
     */
    public function testIfWithToManyArgumentsCausesError()
    {
        $this->execute('(if true "one" "two" "three")');
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

    /**
     * @dataProvider nots
     * @expectedException Chrisguitarguy\Plot\Exception\BadCallException
     */
    public function testNotWithTwoFewArgumentsCausesError()
    {
        $this->execute('(not)');
    }

    /**
     * @dataProvider nots
     * @expectedException Chrisguitarguy\Plot\Exception\BadCallException
     */
    public function testNotWithTwoManyArgumentsCausesError()
    {
        $this->execute('(not true true)');
    }

    public function testOrWithOneTrueValueEvaluatesToTrue()
    {
        $this->assertTrue($this->execute('(or false true)'));
    }

    public function testOrWithNoTrueValuesEvaluatesToVale()
    {
        $this->assertFalse($this->execute('(or false false)'));
        $this->assertFalse($this->execute('(or false)'));
    }

    /**
     * @expectedException Chrisguitarguy\Plot\Exception\BadCallException
     */
    public function testOrWithTooFewArgumentsCausesError()
    {
        $this->execute('(or)');
    }

    public function testAndWithAllTrueARgumentsEvalutesToTrue()
    {
        $this->assertTrue($this->execute('(and (true) true true)'));
        $this->assertTrue($this->execute('(and true)'));
    }

    public function testAndWithFalseArgumentEvaluatesToFalse()
    {
        $this->assertFalse($this->execute('(and (false) true true)'));
        $this->assertFalse($this->execute('(and false)'));
    }

    /**
     * @expectedException Chrisguitarguy\Plot\Exception\BadCallException
     */
    public function testAndWithTooFewArgumentsCausesError()
    {
        $this->execute('(and)');
    }
}
