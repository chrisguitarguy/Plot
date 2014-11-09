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
        $this->checkNumeric($value, current($nodes), $self);

        while (false !== next($nodes)) {
            $node = current($nodes);
            $_value = $node->evaluate($env);
            $this->checkNumeric($_value, $node, $self);
            $value = $this->op($value, $_value);
        }

        return $value;
    }

    abstract protected function op($initial, $value);

    private function checkNumeric($value, Node $node, Node $self)
    {
        if (!is_numeric($value)) {
            throw new BadCallException(sprintf(
                '`%s` expected numeric arguments, got "%s" near %s',
                $self->rawIdent(),
                $value,
                $node->context()
            ));
        }
    }
}
