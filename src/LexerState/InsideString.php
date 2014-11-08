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

final class InsideString extends AbstractState
{
    private $surroundChar;

    public function __construct($char, LexerState $previous)
    {
        $this->surroundChar = $char;
        parent::__construct($previous);
    }

    /**
     * {@inheritdoc}
     */
    public function lex(Input $in, Lexer $lexer)
    {
        $this->expectedSurround($in);

        while (true) {
            $cur = $in->current();
            if (null === $cur) {
                throw new SyntaxError('Unexpected EOF at '.$in->context());
            }

            if ($this->isSurroundChar($cur) && '\\' !== $in->lookbehind()) {
                break;
            }

            $in->next();
        }

        $lexer->emit(Token::STRING_VALUE);

        $this->expectedSurround($in);

        return $this->previousState();
    }

    private function expectedSurround(Input $in)
    {
        if (!$this->isSurroundChar($in->current())) {
            throw new SyntaxError(sprintf(
                'Unexpected "%s" at %s, expected %s',
                $in->current(),
                $in->context(),
                $this->surroundChar
            ));
        }
        $in->next();
        $in->ignore();
    }

    private function isSurroundChar($char)
    {
        return $char === $this->surroundChar;
    }
}
