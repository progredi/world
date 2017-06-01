<?php

namespace Progredi\World\Controller\Admin;

use Cake\Network\Session;
use Progredi\World\Controller\Admin\AppController;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;

/**
 * Regions Controller
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
class RegionsController extends AppController
{
	/**
	 * Index method [Admin]
	 *
	 * @return void
	 */
	public function index()
	{
		// Configure pagination request.

		$this->paginate['Regions'] = [
			'conditions' => parent::index(),
			//'fields' => ['Regions.id', 'Regions.name', 'Regions.enabled'],
			'limit' => $this->paginate['limit'],
			'order' => ['Regions.name' => 'asc'],
			'contain' => [
				'Continents',
				'Countries'
			]
		];

		// Check for invalid pagination requests.

		try {
			$regions = $this->paginate($this->Regions);
		}
		catch (NotFoundException $e) {

			// Check for out of range page request.

			$this->Flash->error(__("Page request out of range"));
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title_for_layout', __('Regions') . TS . __('World'));

		$this->set('regions', $regions);
		$this->set('_serialize', ['regions']);
	}

	/**
	 * Add method [Admin]
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$region = $this->Regions->newEntity();

		$session = $this->request->session();

		if ($this->request->is('post')) {
			$region = $this->Regions->patchEntity($region, $this->request->data);
			if ($this->Regions->save($region)) {
				$this->Flash->success(__('Region details have been saved'));
				if (isset($this->request->data['apply'])) {
					return $this->redirect(['action' => 'edit', $region->id]);
				}
				return $this->redirect($session->read('App.referrer'));
			}
			$this->Flash->error(__('Region details could not be saved, please try again'));
		}

		if (!$this->request->data) {
			$session->write('App.referrer', $this->referer());
		}

		$this->set('title_for_layout', __('Add Region') . TS . __('Regions') . TS . __('World'));

		$this->set('region', $region);
		$this->set('_serialize', ['region']);

		$this->set('continentsOptions', $this->Regions->Continents->options());
	}

	/**
	 * View method [Admin]
	 *
	 * @param string|null $id Region id. Can be null for testing purposes.
	 * @return void Redirects on failed entity retrieval, renders view otherwise.
	 */
	public function view($id = null)
	{
		// Check for entity request errors.

		try {
			$region = $this->Regions->get($id, [
				'contain' => [
					'Continents',
					'Countries'
				]
			]);
		}
		catch (RecordNotFoundException $e) {

			// Record primary key not found in table.

			$this->Flash->error(__('Region not found'));
			return $this->redirect(['action' => 'index']);
		}
		catch (InvalidPrimaryKeyException $e) {

			// Invalid primary key, e.g. NULL.

			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title_for_layout', __('View Region') . TS . __('Regions') . TS . __('World'));

		$session = $this->request->session();
		$session->write('App.referrer', $this->referer());

		$this->set('region', $region);
		$this->set('_serialize', ['region']);
	}

	/**
	 * Edit method [Admin]
	 *
	 * @param string|null $id Region id.
	 * @return void Redirects on successful edit, renders view otherwise.
	 */
	public function edit($id = null)
	{
		// Check for entity request errors.

		try {
			$region = $this->Regions->get($id);
		}
		catch (RecordNotFoundException $e) {

			// Record primary key not found in table.

			$this->Flash->error(__('Region not found'));
			return $this->redirect(['action' => 'index']);
		}
		catch (InvalidPrimaryKeyException $e) {

			// Invalid primary key, e.g. NULL.

			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(['action' => 'index']);
		}

		$session = $this->request->session();

		if ($this->request->is(['patch', 'post', 'put'])) {
			$region = $this->Regions->patchEntity($region, $this->request->data);
			if ($this->Regions->save($region)) {
				$this->Flash->success(__('Region details haves been updated'));
				if (!isset($this->request->data['apply'])) {
					return $this->redirect($session->read('App.referrer'));
				}
			} else {
				$this->Flash->error(__('Region details could not be updated, please try again'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $region;
			$session->write('App.referrer', $this->referer());
		}

		$this->set('title_for_layout', __('Edit Region') . TS . __('Regions') . TS . __('World'));

		$this->set(compact('region'));
		$this->set('_serialize', ['region']);

		$this->set('continentsOptions', $this->Regions->Continents->options());
	}

	/**
	 * Delete method [Admin]
	 *
	 * @param string|null $id EntityName id.
	 * @return void Redirects to referrer or index method
	 */
	public function delete($id = null)
	{
		$this->request->allowMethod(['post', 'delete']);

		// Check for entity request errors.

		try {
			$region = $this->Regions->get($id);
		}
		catch (RecordNotFoundException $e) {

			// Record primary key not found in table.

			$this->Flash->error(__('Region not found'));
			return $this->redirect(env('HTTP_REFERER'));
		}
		catch (InvalidPrimaryKeyException $e) {

			// Invalid primary key, e.g. NULL.

			$this->Flash->error(__("Invalid record id specified"));
			return $this->redirect(env('HTTP_REFERER'));
		}

		if ($this->Regions->delete($region)) {
			$this->Flash->success(__('Region has been deleted'));
		} else {
			$this->Flash->error(__('Region could not be deleted, please try again'));
		}

		return $this->redirect(preg_match('/view|edit/', env('HTTP_REFERER'))
			? ['action' => 'index']
			: env('HTTP_REFERER')
		);
	}
}

//echo "<pre>\n\nData :" . print_r($region->toArray(), true) . "\n</pre>\n\n";
//echo "<pre>\n\nRequest Data :" . print_r($this->request, true) . "\n</pre>\n\n";
//echo "<pre>\n\nConfiguration Data :" . print_r(Configure::read(), true) . "\n</pre>\n\n";
//exit();
