<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

/**
 * Turns an input into a stream of tokens.
 *
 * @since   0.1
 */
class Lexer
{
    /**
     * The current input.
     *
     * @var     Input
     */
    private $input = null;

    /**
     * The current stream of tokens.
     *
     * @var     array
     */
    private $tokens = null;

    public function tokenize(Input $input)
    {
        $this->input = $input;
        $this->tokens = [];

        $state = new LexerState\OpenList();
        do {
            $state = $state->lex($this->input, $this);
        } while (LexerState\LexerState::STOP_TOKENIZING !== $state);

        return new TokenStream($this->tokens);
    }

    /**
     * Emit token to the lexer, slicing off the current.
     *
     * @param   int $tokenType
     */
    public function emit($tokenType)
    {
        $ctx = $this->input->context();
        $this->tokens[] = new Token($tokenType, trim($this->input->slice()), $ctx);
    }
}
