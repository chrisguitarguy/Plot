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

final class ListNode implements Node
{
    private $children = array();

    public function evaluate(Environment $env)
    {
        if (empty($this->children)) {
            return null;
        }

        $values = array();
        $callable = null;

        $wrappedEnv = new Environment($env);
        foreach ($this->children as $node) {
            $values[] = $node->evaluate($wrappedEnv);
        }

        if (is_callable($values[0])) {
            return call_user_func(
                $values[0],
                array_slice($values, 1),
                array_slice($this->children, 1),
                $env
            );
        }

        return array_pop($values);
    }

    public function add(Node $node)
    {
        $this->children[] = $node;
    }
}
