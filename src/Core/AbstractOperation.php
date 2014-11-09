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
use Chrisguitarguy\Plot\Exception\BadCallException;
use Chrisguitarguy\Plot\Node\Node;

abstract class AbstractOperation
{
    public function __invoke(array $nodes, Environment $env, Node $self)
    {
        if (count($nodes) < 1) {
            throw new BadCallException(sprintf(
                '`%s` expects at least one argument, %d given near %s',
                $self->rawIdent(),
                count($nodes),
                $self->context()
            ));
        }

        reset($nodes);
        $value = current($nodes)->evaluate($env);
        while (false !== next($nodes)) {
            $node = current($nodes);
            $value = $this->op($value, $node->evaluate($env));
        }

        return $value;
    }

    abstract protected function op($initial, $value);
}
