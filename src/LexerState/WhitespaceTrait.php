<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot\LexerState;

trait WhitespaceTrait
{
    public function isWhitespace($char)
    {
        return trim($char) === '';
    }
}
