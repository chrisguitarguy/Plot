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

final class LogicalOr
{
    public function __invoke(array $nodes, Environment $env, Node $self)
    {
        if (count($nodes) < 1) {
            throw new BadCallException(sprintf(
                '`or` expects at least 1 argument, got %d near %s',
                count($nodes),
                $self->context()
            ));
        }

        foreach ($nodes as $node) {
            if ($node->evaluate($env)) {
                return true;
            }
        }

        return false;
    }
}
