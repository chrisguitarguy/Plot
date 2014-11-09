<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

final class Token
{
    const EOF           = 'EOF';
    const OPEN_LIST     = 'OPEN_LIST';
    const CLOSE_LIST    = 'CLOSE_LIST';
    const STRING_VALUE  = 'STRING_VALUE';
    const INT_VALUE     = 'INT_VALUE';
    const FLOAT_VALUE   = 'FLOAT_VALUE';
    const IDENTIFIER    = 'IDENTIFIER';

    private $type;
    private $value;
    private $context;

    public function __construct($type, $value, $context)
    {
        $const = @constant(__CLASS__."::{$type}");
        if (!$const) {
            throw new \InvalidArgumentException("{$type} is not a value token type");
        }

        $this->type = $type;
        $this->value = $value;
        $this->context = $context;;
    }

    public function getType()
    {
        return $this->type;
    }

    public function isType($tokenType)
    {
        return $this->getType() === $tokenType;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getContext()
    {
        return $this->context;
    }

    public function __toString()
    {
        $val = $this->getValue();

        return sprintf(
            'Token(%s, "%s")',
            $this->getType(),
            mb_strlen($val) > 10 ? mb_substr($val, 0, 10).'...' : $val
        );
    }
}
