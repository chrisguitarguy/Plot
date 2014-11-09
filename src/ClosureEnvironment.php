<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

/**
 * An Environment implementation that keeps track of a "local" environment as
 * well as a closed over environment.
 *
 * @since   0.1
 */
final class ClosureEnvironment implements Environment
{
    private $local;

    private $closed;

    public function __construct(Environment $local, Environment $closed)
    {
        $this->local = $local;
        $this->closed = $closed;
    }

    public function has($ident)
    {
        return $this->local->has($ident) || $this->closed->has($ident);
    }

    public function get($ident)
    {
        return $this->local->has($ident) ? $this->local->get($ident) : $this->closed->get($ident);
    }

    public function put($ident, $val)
    {
        $this->local->put($ident, $val);
    }

    public function hasParent()
    {
        return $this->local->hasParent();
    }

    public function putParent($ident, $val)
    {
        $this->local->putParent($ident, $val);
    }
}
