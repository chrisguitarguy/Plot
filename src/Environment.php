<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

class Environment
{
    private $values = array();

    private $parent = null;

    public function __construct(Environment $parent=null)
    {
        $this->parent = $parent;
    }

    public static function createDefaultEnvironment()
    {
        $env = new static();

        return $env;
    }

    public function has($ident)
    {
        return isset($this->values[$ident]) || $this->parentHas($ident);
    }

    public function get($ident)
    {
        if (isset($this->values[$ident])) {
            return $this->values[$ident];
        }

        if ($this->parentHas($ident)) {
            return $this->parent->get($ident);
        }

        throw new Exception\IdentityMissingException(sprintf(
            'Could not find "%s" in the environment',
            $ident
        ));
    }

    public function put($ident, $value)
    {
        $this->values[$ident] = $value;
    }

    private function parentHas($ident)
    {
        if (!$this->parent) {
            return false;
        }

        return $this->parent->has($ident);
    }
}
