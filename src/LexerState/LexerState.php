<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot\LexerState;

use Chrisguitarguy\Plot\Lexer;
use Chrisguitarguy\Plot\Input;

/**
 * Represents a lexer state.
 *
 * @since   0.1
 */
interface LexerState
{
    const STOP_TOKENIZING = null;

    public function lex(Input $input, Lexer $lexer);
}
