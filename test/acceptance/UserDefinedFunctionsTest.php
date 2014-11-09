<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

class userDefinedFunctionsTest extends AcceptTestCase
{
    public function testUserFunctionWithEmptyParameterListEvalutesReturnValue()
    {
        $result = $this->execute('((lambda () 1))');
        $this->assertEquals(1, $result);
    }

    public function testUserFunctionWithParameterPassesParametersFromCall()
    {
        $result = $this->execute('((lambda (x) x) 2)');
        $this->assertEquals(2, $result);
    }

    public function testDefinedUserFunctionsCanBeReusedFurtherOnInTheScript()
    {
        $result = $this->execute('(define fn (lambda () true)) (fn)');
        $this->assertTrue($result);
    }

    /**
     * @expectedException Chrisguitarguy\Plot\Exception\BadCallException
     */
    public function testUserFunctionCallWithToFewArgumentsCausesError()
    {
        $this->execute('((lambda (x) x))');
    }

    /**
     * @expectedException Chrisguitarguy\Plot\Exception\BadCallException
     */
    public function testUserFunctionCallWithToManyArgumentsCausesError()
    {
        $this->execute('((lambda (x) x) "one" "two")');
    }
}
