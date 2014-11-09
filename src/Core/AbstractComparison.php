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

/**
 * ABC for comparison nodes
 *
 * @since   0.1
 */
abstract class AbstractComparison
{
    public function __invoke(array $nodes, Environment $env)
    {
        if (count($nodes) < 2) {
            return true; // one element will always be true...
        }

        reset($nodes);
        $cur = current($nodes);
        $prevVal = $cur->evaluate($env);
        while (false !== next($nodes)) {
            $cur = current($nodes);
            $curVal = $cur->evaluate($env);
            if (!$this->compare($prevVal, $curVal)) {
                return false;
            }
            $prevVal = $curVal;
        }

        return true;
    }

    abstract protected function compare($one, $two);
}
