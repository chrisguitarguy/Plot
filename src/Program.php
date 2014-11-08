<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

/**
 * Represents the compiled program as a whole.
 *
 * @since   0.1
 */
class Program
{
    private $nodes;

    public function __construct(array $nodes)
    {
        $this->nodes = $nodes;
    }

    /**
     * Evaluate the program and return the result.
     *
     * @param   $env The initial environment
     * @return  mixed
     */
    public function evaluate(Environment $env=null)
    {
        $env = $env ?: Environment::createDefaultEnvironment();

        $result = null;
        foreach ($this->nodes as $node) {
            $result = $node->evaluate($env);
        }

        return $result;
    }
}
