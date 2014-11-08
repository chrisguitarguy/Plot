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
 * Parses the open parenthesis in a list. This is the initial state.
 *
 * @since   0.1
 */
final class OpenList extends AbstractState
{
    use WhitespaceTrait;
    use ListTrait;

    /**
     * {@inheritdoc}
     */
    public function lex(Input $in, Lexer $lexer)
    {
        $char = $in->next();
        if (null === $char) {
            $lexer->emit(Token::EOF);
            return self::STOP_TOKENIZING;
        }

        while ($this->isWhitespace($char)) {
            $char = $in->next();
        }

        if (!$this->isOpenList($char)) {
            throw new SyntaxError(sprintf(
                'Unexpected "%s" at %s, expected (',
                $char,
                $in->context()
            ));
        }

        $lexer->emit(Token::OPEN_LIST);

        return new InsideList($this->previousState());
    }
}
