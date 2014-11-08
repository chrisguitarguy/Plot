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
 * Throw when the evironment cannot find a value.
 *
 * @since   0.1
 */
class IdentityMissingException extends \RuntimeException implements PlotException
{

}
