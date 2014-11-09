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
use Chrisguitarguy\Plot\Node\ListNode;
use Chrisguitarguy\Plot\Node\IdentifierNode;
use Chrisguitarguy\Plot\Exception\BadCallException;

final class Lambda
{
    public function __invoke(array $nodes, Environment $env, Node $self)
    {
        if (count($nodes) < 2) {
            throw new BadCallException(sprintf(
                '`lambda` expects at least 2 arguments, got %d near %s',
                count($nodes),
                $self->context()
            ));
        }

        $args = $nodes[0];
        if (!$args instanceof ListNode) {
            throw new BadCallException(sprintf(
                'The first argument to `lambda` must be a list of arguments near %s',
                $args->context()
            ));
        }

        $argNames = $this->extractArguments($args);

        return new UserFunc(clone $env, $argNames, array_slice($nodes, 1));
    }

    private function extractArguments(ListNode $args)
    {
        $argNames = array();
        foreach ($args as $arg) {
            if (!$arg instanceof IdentifierNode) {
                throw new BadCallException(sprintf(
                    '`lambda` arguments must be indetifier, got "%s" near %s',
                    get_class($arg),
                    $arg->context()
                ));
            }

            $argNames[] = $arg->rawIdent();
        }

        return $argNames;
    }
}
