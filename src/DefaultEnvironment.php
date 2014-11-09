<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

class DefaultEnvironment implements Environment
{
    private $values = array();

    private $parent = null;

    public function __construct(Environment $parent=null)
    {
        $this->parent = $parent;
    }

    public static function create()
    {
        $env = new static();
        $env->put('define', new Core\Def());
        $env->put('println!', new Core\PrintLine());
        $env->put('print!', new Core\PrintCharacters());
        $env->put('when', new Core\When());
        $env->put('=', new Core\Eq());
        $env->put('eq', new Core\Eq());
        $env->put('>', new Core\Gt());
        $env->put('gt', new Core\Gt());
        $env->put('>=', new Core\Gte());
        $env->put('gte', new Core\Gte());
        $env->put('<', new Core\Lt());
        $env->put('lt', new Core\Lt());
        $env->put('<=', new Core\Lte());
        $env->put('lte', new Core\Lte());

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

    public function putParent($ident, $value)
    {
        $this->getParent()->put($ident, $value);
    }

    public function hasParent()
    {
        return null !== $this->parent;
    }

    public function __clone()
    {
        $this->parent = clone $this->parent;
    }

    private function parentHas($ident)
    {
        if (!$this->hasParent()) {
            return false;
        }

        return $this->parent->has($ident);
    }

    private function getParent()
    {
        if (!$this->hasParent()) {
            throw new Exception\NoParentException('Evironment does not have parent');
        }

        return $this->parent;
    }
}
