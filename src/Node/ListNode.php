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

final class ListNode extends AbstractNode
{
    private $children = array();

    public function evaluate(Environment $env)
    {
        if (empty($this->children)) {
            return null;
        }

        $values = array();
        var_dump(__METHOD__);

        reset($this->children);
        $node = current($this->children);
        $first = true;
        while (false !== $node) {
            $value = $node->evaluate($node instanceof ListNode ? new Environment($env) : $env);

            if ($first && is_callable($value)) {
                return call_user_func($value, array_slice($this->children, 1), $env);
            }

            $values[] = $value;

            next($this->children);
            $node = current($this->children);
            $first = false;
        }

        return array_pop($values);
    }

    public function add(Node $node)
    {
        $this->children[] = $node;
    }
}
