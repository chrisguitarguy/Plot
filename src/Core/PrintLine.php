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

class PrintLine
{
    public function __invoke(array $nodes, Environment $env)
    {
        $values = array();
        foreach ($nodes as $node) {
            $values[] = $node->evaluate($env);
        }

        echo implode(' ', $values), PHP_EOL;
    }
}
