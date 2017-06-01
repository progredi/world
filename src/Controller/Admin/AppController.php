<?php

namespace Progredi\World\Controller\Admin;

use App\Controller\Admin\AppController as BaseController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;

/**
 * World Admin AppController
 *
 * PHP5/7
 *
 * @category  Controller
 * @package   Progredi\World
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      https://github.com/progredi/world
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
		'Html' => ['templates' => 'templates'],
		'Paginator' => ['templates' => 'templates/paginator'],
		'Form' => ['templates' => 'templates/form']
	];

	/**
	 * Initialize()
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

	/**
	 * BeforeFilter method [Admin]
	 *
	 * @access public
	 * @return void
	 */
	public function beforeFilter(Event $event)
	{
		parent::beforeFilter($event);
		if ($this->request->is('ajax')) {
			$this->response->disableCache();
		}
	}

	// SHARED FUNCTIONS

	/**
	 * Index method [Admin]
	 * 
	 * Provides text search functionality.
	 *
	 * @access public
	 * @return array
	 */
	public function index()
	{
		$conditions = [];
		$model = $this->name;

		if ($this->request->is(['get']) && isset($this->request->query['column'])) {
			$column = $this->request->query['column'];
			$value = $this->request->query['value'];
			$conditions = $column == 'id'
				? ["$model.id" => [$value]]
				:  ["$model.$column LIKE" => "%$value%"];
		}

		return $conditions;
	}

	/**
	 * Enable method [Admin]
	 *
	 * @access public
	 * @return string
	 */
	public function enable($id = null)
	{
		if (!$id) {
			$this->Flash->error(__('Invalid request: no record id specified'));
			return $this->redirect($this->referer());
		}

		$table = TableRegistry::get($this->request->params['plugin'] . '.' . $this->name);
		$entity = $table->get($id);

		$entity->enabled = true;

		if ($table->save($entity)) {
			$this->Flash->success(__(Inflector::singularize($this->name) . ' has been enabled'));
			return $this->redirect($this->referer());
		}
		$this->Flash->error(__(Inflector::singularize($this->name) . ' could not be enabled'));
		return $this->redirect($this->referer());
	}

	/**
	 * Disable method [Admin]
	 *
	 * @access public
	 * @return string
	 */
	public function disable($id = null)
	{
		if (!$id) {
			$this->Flash->error(__('Invalid request: no record id specified'));
			return $this->redirect($this->referer());
		}

		$table = TableRegistry::get($this->request->params['plugin'] . '.' . $this->name);
		$entity = $table->get($id);

		$entity->enabled = false;

		if ($table->save($entity)) {
			$this->Flash->success(__(Inflector::singularize($this->name) . ' has been disabled'));
			return $this->redirect($this->referer());
		}
		$this->Flash->error(__(Inflector::singularize($this->name) . ' could not be disabled'));
		return $this->redirect($this->referer());
	}
}
