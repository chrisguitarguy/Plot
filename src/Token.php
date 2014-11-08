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

    private $type;
    private $value;

    public function __construct($type, $value)
    {
        $const = @constant(__CLASS__."::{$type}");
        if (!$const) {
            throw new \InvalidArgumentException("{$type} is not a value token type");
        }

        $this->type = $type;
        $this->value = $value;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function __toString()
    {
        $val = $this->getValue();

        return sprintf(
            'Token(%s, %s)',
            $this->getType(),
            mb_strlen($val) > 10 ? mb_substr($val, 0, 10).'...' : $val
        );
    }
}