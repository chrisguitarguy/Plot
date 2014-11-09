<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

namespace Chrisguitarguy\Plot;

interface Environment
{
    public function has($ident);

    public function put($ident, $value);

    public function get($ident);

    public function hasParent();

    public function putParent($ident, $value);
}
