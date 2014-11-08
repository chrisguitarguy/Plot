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
 * Parses the inside contents of a list
 *
 * @since   0.1
 */
final class InsideList extends AbstractState
{
    use WhitespaceTrait;
    use ListTrait;

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

            if (!$this->isWhitespace($char)) {
                break;
            }

            $in->next();
        }

        $cur = $in->current();
        switch ($cur) {
            case '(':
                return new OpenList($this);
                break;
            case ')':
                return new CloseList($this->previousState());
                break;
            case '"':
                return new InsideString('"', $this);
                break;
            case "'":
                return new InsideString("'", $this);
                break;
            case '+':
            case '-':
                $next = $in->peek();
                if ($this->isWhitespace($next) || $this->isCloseList($next)) {
                    return new InsideIdent($this);
                    break;
                }
            case '0':
            case '1':
            case '2':
            case '3':
            case '4':
            case '5':
            case '6':
            case '7':
            case '8':
            case '9':
                return new InsideNumber($this);
                break;
            case null:
                throw new SyntaxError('Unexpected EOF at '.$in->context());
                break;
            default:
                return new InsideIdent($this);
                break;
        }
    }
}
