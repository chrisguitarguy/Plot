<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot\LexerState;

trait ListTrait
{
    public function isOpenList($char)
    {
        return '(' === $char;
    }

    public function isCloseList($char)
    {
        return ')' === $char;
    }
}
