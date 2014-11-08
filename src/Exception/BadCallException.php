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
 * Thrown when some core function is called incorrectly.
 *
 * @since   0.1
 */
class BadCallException extends \RuntimeException implements PlotException
{

}
