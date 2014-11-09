<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot\Node;

use Chrisguitarguy\Plot\Environment;

/**
 * represents a "compiled" node in the program.
 *
 * @since   0.1
 */
interface Node
{
    /**
     * Evaluate the node to a value.
     *
     * @param   $env The environment of the node
     * @return  mixed
     */
    public function evaluate(Environment $env);

    /**
     * Get the context of the node -- where it appeared in the input.
     *
     * @return  string
     */
    public function context();
}
