<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

class TokenStream implements \Iterator, \Countable
{
    private $tokens;

    private $current = 0;

    public function __construct(array $tokens)
    {
        $this->tokens = $tokens;
    }

    public function at($idx)
    {
        if (!isset($this->tokens[$idx])) {
            throw new \OutOfBoundsException("Token at {$idx} not available");
        }

        return $this->tokens[$idx];
    }

    public function current()
    {
        return $this->tokens[$this->current];
    }

    public function key()
    {
        return $this->current;
    }

    public function next()
    {
        $this->current++;
    }

    public function rewind()
    {
        $this->current = 0;
    }

    public function valid()
    {
        return isset($this->tokens[$this->current]) && !$this->current()->isType(Token::EOF);
    }

    public function count()
    {
        return count($this->tokens);
    }
}
