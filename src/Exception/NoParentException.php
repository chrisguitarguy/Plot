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
 * throw when someone tries to access a non-existent environment parent
 *
 * @since   0.1
 */
class NoParentException extends \UnexpectedValueException implements PlotException
{

}
