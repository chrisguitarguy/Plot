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

final class InsideIdent extends AbstractState
{
    use WhitespaceTrait;
    use ListTrait;

    public function __construct(LexerState $previous)
    {
        parent::__construct($previous);
    }

    /**
     * {@inheritdoc}
     */
    public function lex(Input $in, Lexer $lexer)
    {
        while (true) {
            $char = $in->current();
            if (null === $char) {
                throw new SyntaxError('Unexpected EOF at '.$in->context());
            }

            if ($this->isWhitespace($char) || $this->isCloseList($char)) {
                break;
            }

            $in->next();
        }

        $lexer->emit(Token::IDENTIFIER);

        return $this->previousState();
    }
}
