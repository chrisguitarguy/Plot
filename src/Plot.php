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
 * A facade around the whole system
 */
class Plot
{
    private $parser;

    public function __construct(Parser $parser=null)
    {
        $this->parser = $parser ?: new Parser();
    }

    public function evaluateString($str)
    {
        return $this->parser->parse(Input::fromString($str))->evaluate();
    }

    public function evaluateFile($filename)
    {
        return $this->parser->parser(Input::fromFile($filename))->evaluate();
    }
}
