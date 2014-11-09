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
use Chrisguitarguy\Plot\Node\IdentifierNode;
use Chrisguitarguy\Plot\Exception\BadCallException;

class Def
{
    public function __invoke(array $nodes, Environment $env, Node $self)
    {
        if (count($nodes) !== 2) {
            throw new BadCallException(sprintf(
                '`define` expects exactly 2 arguments, got %d near %s',
                count($nodes),
                $self->context()
            ));
        }

        if (!$nodes[0] instanceof IdentifierNode) {
            throw new BadCallException(sprintf(
                'The first argument of `define` must be an identifier, got %s. %s',
                get_class($nodes[0]),
                $nodes[0]->context()
            ));
        }

        // since `(define ...)` is going to be inside its own "environment"
        // as its inside a list, we want to put the value into the parent
        // environment. This is how we get scopes and such.
        $env->putParent($nodes[0]->rawIdent(), $nodes[1]->evaluate($env));

        return null;
    }
}
