<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot\LexerState;

/**
 * ABC for lexer states. Provides the "previous" state.
 *
 * @since   0.1
 */
abstract class AbstractState implements LexerState
{
    private $previousState = null;

    public function __construct(LexerState $previous=null)
    {
        $this->previousState = $previous;
    }

    /**
     * Get the previous state.
     *
     * @return  LexerState|null
     */
    protected function previousState()
    {
        return $this->previousState;
    }
}
