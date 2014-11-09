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
use Chrisguitarguy\Plot\ClosureEnvironment;
use Chrisguitarguy\Plot\Node\Node;

class UserFunc
{
    private $wrappedEnv;

    private $argNames;

    private $nodes;

    public function __construct(Environment $env, array $argNames, array $nodes)
    {
        $this->wrappedEnv = $env;
        $this->argNames = $argNames;
        $this->nodes = $nodes;
    }

    public function __invoke(array $nodes, Environment $env, Node $self)
    {
        if (count($nodes) !== count($this->argNames)) {
            throw new BadCallException(sprintf(
                'Expected %d arguments, got %d near %s',
                count($this->argNames),
                count($nodes),
                $self->context()
            ));
        }

        foreach (array_combine($this->argNames, $nodes) as $name => $node) {
            $env->put($name, $node->evaluate($env));
        }

        $value = null;
        $closure = new ClosureEnvironment($env, $this->wrappedEnv);
        foreach ($this->nodes as $node) {
            $value = $node->evaluate($closure);
        }

        return $value;
    }
}
