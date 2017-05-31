<?php

namespace World\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Session;

/**
 * World AppController
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
class AppController extends BaseController
{
	/**
	 * Helpers
	 *
	 * @var array
	 * @access public
	 */
	public $helpers = [
		'Html' => ['templates' => 'templates']
	];

	/**
	 * initialize()
	 *
	 * @access public
	 * @return void
	 */
	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Flash');
		$this->loadComponent('Paginator');
	}
}
