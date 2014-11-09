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
use Chrisguitarguy\Plot\Node\Node;
use Chrisguitarguy\Plot\Exception\BadCallException;

final class LogicalAnd
{
    public function __invoke(array $nodes, Environment $env, Node $self)
    {
        if (count($nodes) < 1) {
            throw new BadCallException(sprintf(
                '`and` expects at least 1 argument, got %d near %s',
                count($nodes),
                $self->context()
            ));
        }

        $results = array_filter(array_map(function ($node) use ($env) {
            return $node->evaluate($env);
        }, $nodes));

        return count($results) === count($nodes);
    }
}
