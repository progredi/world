<?php

use Cake\Core\Configure;

/**
 * Bootstrap
 *
 * @category  Config
 * @package   CakePHP World Plugin
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2016 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-world-plugin
 */

// Define header title separator
if (!defined('TS')) {
	define('TS', Configure::read('Site.title_separator'));
}
