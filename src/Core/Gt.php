<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot\Core;

use Chrisguitarguy\Plot\Environment;

class Gt extends AbstractComparison
{
    protected function compare($one, $two)
    {
        return $one > $two;
    }
}
