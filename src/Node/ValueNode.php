<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot\Node;

use Chrisguitarguy\Plot\Token;
use Chrisguitarguy\Plot\Environment;

final class ValueNode extends AbstractNode
{
    private $value;

    public function __construct($value, Token $token)
    {
        parent::__construct($token);
        $this->value = $value;
    }

    public function evaluate(Environment $env)
    {
        return $this->value;
    }
}
