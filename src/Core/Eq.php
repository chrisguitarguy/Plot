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

class Eq
{
    public function __invoke(array $nodes, Environment $env)
    {
        if (count($nodes) < 2) {
            return true; // one value will always equal itself.
        }

        $values = [];
        foreach ($nodes as $node) {
            $values[] = $node->evaluate($env);
        }

        return count(array_unique($values)) === 1;
    }
}
