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
use Chrisguitarguy\Plot\DefaultEnvironment;

final class ListNode extends AbstractNode implements \IteratorAggregate
{
    private $children = array();

    public function evaluate(Environment $env)
    {
        if (empty($this->children)) {
            return null;
        }

        $values = array();

        reset($this->children);
        $node = current($this->children);
        $first = true;
        while (false !== $node) {
            $value = $node->evaluate($node instanceof ListNode ? new DefaultEnvironment($env) : $env);

            if ($first && is_callable($value)) {
                return call_user_func($value, array_slice($this->children, 1), $env, $node);
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

    public function getIterator()
    {
        return new \ArrayIterator($this->children);
    }
}
