<?php

namespace World\Controller\Admin;

use World\Controller\Admin\AppController;

/**
 * World Controller
 *
 * PHP5
 *
 * @category  Controller
 * @package   CakePHP World Plugin
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2016 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-world-plugin
 */
class WorldController extends AppController
{
	/**
	 * Dashboard method
	 *
	 * @return void
	 */
	public function dashboard()
	{
		$this->set('title_for_layout', __('Dashboard') . TS . __('World') . TS . __('Admin'));
	}
}
