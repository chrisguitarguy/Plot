<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

class AcceptTestCase extends \PHPUnit_Framework_TestCase
{
    protected $plot = null;

    protected function execute($string)
    {
        return $this->getPlot()->evaluateString($string);
    }

    protected function getPlot()
    {
        if (null === $this->plot) {
            $this->plot = new Plot();
        }

        return $this->plot;
    }
}
