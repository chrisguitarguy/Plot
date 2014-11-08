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

final class InsideNumber extends AbstractState
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
        $cur = $in->current();
        if ('+' === $cur || '-' === $cur) {
            $in->next();
        }

        $isHex = false;
        $digits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9']; // range('0', '9')? lolphp
        if ('0' === $in->current() && in_array($in->peek(), ['x', 'X'])) {
            $in->next();
            $in->next();
            $isHex = true;
            $digits = array_merge($digits, range('a', 'f'), range('A', 'F'));
        }

        $this->consumeDigits($in, $digits);
        $char = $in->current();
        if ($isHex || '.' !== $char) {
            $this->checkNumberFinished($char, $in);
            $lexer->emit(Token::INT_VALUE);
        } elseif ('.' === $char) {
            $in->next();
            $this->consumeDigits($in, $digits);
            $this->checkNumberFinished($in->peek(), $in);
            $lexer->emit(TOKEN::FLOAT_VALUE);
        }

        return $this->previousState();
    }

    private function consumeDigits(Input $in, array $digits)
    {
        while (true) {
            $char = $in->current();
            if (!$this->isDigit($char, $digits)) {
                break;
            }
            $in->next();
        }
    }

    private function isDigit($char, array $digits)
    {
        return in_array($char, $digits);
    }

    private function checkNumberFinished($char, Input $in)
    {
        if (!$this->isWhitespace($char) && !$this->isCloseList($char)) {
            throw new SyntaxError(sprintf(
                'Unexpected "%s" at %s, expected whitespace or )',
                $char,
                $in->context()
            ));
        }
    }
}
