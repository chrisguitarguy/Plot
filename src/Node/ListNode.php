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
        
    }

    public function add(Node $node)
    {
        $this->children[] = $node;
    }
}
