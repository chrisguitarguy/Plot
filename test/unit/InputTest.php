<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

class InputTest extends UnitTestCase
{
    /**
     * @expectedException UnexpectedValueException
     */
    public function testZeroLengthStringsCauseError()
    {
        Input::fromString('');
    }

    public function testCurrentReturnsCharacterAtTheCurrentPosition()
    {
        $this->assertEquals('o', Input::fromString('one')->current());
    }

    public function testNextReturnsTheCurrentCharacterAndAdvancesTheCursor()
    {
        $in = Input::fromString('one');

        $this->assertEquals('o', $in->next());
        $this->assertEquals('n', $in->current());
    }

    public function testNextAndCurrentReturnNullWhenTheEndOfInputHasBeenReached()
    {
        $in = Input::fromString('t');
        $in->next();
        $this->assertNull($in->current());
        $this->assertNull($in->next());
    }

    public function testPeekLooksAtNextCharacterWithoutChangingPosition()
    {
        $in = Input::fromString('two');

        $this->assertEquals('w', $in->peek());
        $this->assertEquals('t', $in->current());
    }
}
