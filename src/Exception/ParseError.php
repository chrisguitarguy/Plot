<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot\Exception;

use Chrisguitarguy\Plot\PlotException;

/**
 * Thrown when the parser can't make sense of things.
 *
 * @since   0.1
 */
class ParseError extends \UnexpectedValueException implements PlotException
{

}
