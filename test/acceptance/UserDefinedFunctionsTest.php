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

    public function testUserFunctionsCanBeReusedFurtherOnInTheScript()
    {
        $result = $this->execute('(define fn (lambda () true)) (fn)');
        $this->assertTrue($result);
    }

    public function testUserFunctionsCanBeRecursive()
    {
        $prog ="
        (define fn (lambda (countdown) (if (<= countdown 0) 'boom' (recur (- countdown 1)))))
        (fn 10)";

        $result = $this->execute($prog);
        $this->assertEquals('boom', $result);
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
