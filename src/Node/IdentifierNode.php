<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot\Node;

use Chrisguitarguy\Plot\Environment;

final class IdentifierNode implements Node
{
    private $ident;

    public function __construct($ident)
    {
        $this->ident = $ident;
    }

    public function evaluate(Environment $env)
    {
        switch ($this->ident) {
            case 'true':
                return true;
                break;
            case 'false':
                return false;
                break;
            case 'null':
                return null;
                break;
            default:
                return $env->get($this->ident);
                break;
        }
    }
}
