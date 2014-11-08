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
use Chrisguitarguy\Plot\Token;
use Chrisguitarguy\Plot\Exception\SyntaxError;

/**
 * Parses the closing parenthesis in a list. This is the initial state.
 *
 * @since   0.1
 */
final class CloseList extends AbstractState
{
    use ListTrait;

    /**
     * {@inheritdoc}
     */
    public function lex(Input $in, Lexer $lexer)
    {
        if (!$this->isCloseList($in->next())) {
            throw new SyntaxError(sprintf(
                'Unexpected "%s" at %s, expected (',
                $in->current(),
                $in->context()
            ));
        }

        $lexer->emit(Token::CLOSE_LIST);

        return $this->previousState() ?: new OpenList();
    }
}
