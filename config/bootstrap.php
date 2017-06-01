<?php

use Cake\Core\Configure;

/**
 * Bootstrap
 *
 * @category  Config
 * @package   Progredi\World
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      https://github.com/progredi/world
 */

// Define header title separator
if (!defined('TS')) {
	define('TS', Configure::read('Site.title_separator'));
}
