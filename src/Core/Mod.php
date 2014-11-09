<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot\Core;

class Mod extends AbstractOperation
{
    protected function op($initial, $value)
    {
        return $initial % $value;
    }
}
