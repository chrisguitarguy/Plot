<?php
/**
 * This file is part of Plot
 *
 * @package     Chrisguitarguy\Plot
 * @copyright   2014 Christopher Davis
 * @license     http://opensource.org/licenses/mit MIT
 */

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->addPsr4('Chrisguitarguy\\Plot\\', __DIR__.'/unit');
$loader->addPsr4('Chrisguitarguy\\Plot\\', __DIR__.'/acceptance');
