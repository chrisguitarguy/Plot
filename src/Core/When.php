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
use Chrisguitarguy\Plot\Exception\BadCallException;

class When
{
    public function __invoke(array $nodes, Environment $env)
    {
        if (count($nodes) !== 2) {
            throw new BadCallException(sprintf(
                '`when` expects exactly 2 arguments, got %d',
                count($values)
            ));
        }

        return $nodes[0]->evaluate($env) ? $nodes[1]->evaluate($env) : null;
    }
}
