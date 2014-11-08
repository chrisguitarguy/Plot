<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

class TokenStream implements \IteratorAggregate, \Countable
{
    private $tokens;

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

    public function getIterator()
    {
        return new \ArrayIterator($this->tokens);
    }

    public function count()
    {
        return count($this->tokens);
    }
}
