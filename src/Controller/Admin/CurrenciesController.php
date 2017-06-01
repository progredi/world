<?php

namespace Progredi\World\Controller\Admin;

use Cake\Filesystem\File;
use Cake\Network\Session;
use Progredi\World\Controller\Admin\AppController;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;

/**
 * Currencies Controller
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
class CurrenciesController extends AppController
{
	/**
	 * Index method [Admin]
	 *
	 * @return void
	 */
	public function index()
	{
		$this->paginate['Currencies'] = [
			'conditions' => parent::index(),
			'limit' => $this->paginate['limit'],
			'order' => ['Currencies.name' => 'asc']
		];

		// Check for invalid pagination requests.

		try {
			$currencies = $this->paginate($this->Currencies);
		}
		catch (NotFoundException $e) {

			// Check for out of range page request.

			$this->Flash->error(__("Page request out of range"));
			return $this->redirect(['action' => 'index']);
		}

		$this->set('title_for_layout', __('Currencies') . TS . __('World'));

		$session = $this->request->session();
		$session->write('App.referrer', $this->request->here);

		$this->set('currencies', $currencies);
		$this->set('_serialize', ['currencies']);
	}

	/**
	 * Add method [Admin]
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function add()
	{
		$session = $this->request->session();

		$currency = $this->Currencies->newEntity();

		if ($this->request->is('post')) {
			$currency = $this->Currencies->patchEntity($currency, $this->request->data);
			if ($this->Currencies->save($currency)) {
				$this->Flash->success(__('Currency details have been saved'));
				if (isset($this->request->data['apply'])) {
					return $this->redirect(['action' => 'edit', $this->Currencies->id]);
				}
				return $this->redirect($session->read('App.referrer'));
			}
			$this->Flash->error(__('Currency details could not be saved, please try again'));
		}

		if (!$this->request->data) {
			$session->write('App.referrer', $this->referer());
		}

		$this->set('title_for_layout', __('Add Currency') . TS . __('Currencies') . TS . __('World'));

		$this->set('currency', $currency);
		$this->set('_serialize', ['currency']);
	}

	/**
	 * View method [Admin]
	 *
	 * @param string|null $id Currency id. Can be null for testing purposes.
	 * @return void Redirects on failed entity retrieval, renders view otherwise.
	 */
	public function view($id = null)
	{
		// Check for entity request errors.

		try {
			$currency = $this->Currencies->get($id, [
				'contain' => ['Countries']
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

		$this->set('title_for_layout', __('View Currency') . TS . __('Currencies') . TS . __('World'));

		$session = $this->request->session();
		$session->write('App.referrer', $this->referer());

		$this->set('currency', $currency);
		$this->set('_serialize', ['currency']);
	}

	/**
	 * Edit method [Admin]
	 *
	 * @param string|null $id Currency id. Can be null for testing purposes.
	 * @return void Redirects on failed entity retrieval, renders view otherwise.
	 */
	public function edit($id = null)
	{
		// Check for entity request errors.

		try {
			$currency = $this->Currencies->get($id);
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
			$currency = $this->Currencies->patchEntity($currency, $this->request->data);
			if ($this->Currencies->save($currency)) {
				$this->Flash->success(__('Currency details haves been updated'));
				if (!isset($this->request->data['apply'])) {
					return $this->redirect($session->read('App.referrer'));
				}
			} else {
				$this->Flash->error(__('Currency details could not be updated, please try again'));
			}
		}

		if (!$this->request->data) {
			$this->request->data = $currency;
			$session->write('App.referrer', $this->referer());
		}

		$this->set('title_for_layout', __('Edit Currency') . TS . __('Currencies') . TS . __('World'));

		$this->set('currency', $currency);
		$this->set('_serialize', ['currency']);
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
			$currency = $this->Currencies->get($id);
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

		if ($this->Currencies->delete($currency)) {
			$this->Flash->success(__('Currency has been deleted'));
		} else {
			$this->Flash->error(__('Currency could not be deleted, please try again'));
		}

		return $this->redirect(preg_match('/view|edit/', env('HTTP_REFERER'))
			? ['action' => 'index']
			: env('HTTP_REFERER')
		);
	}

	/**
	 * Import method [Admin]
	 *
	 * @return void Redirects on successful add, renders view otherwise.
	 */
	public function import($id = null)
	{
		$file = new File(TMP . 'currency-symbols.csv');
		$contents = explode("\n", preg_replace("/(\r\n|\r)/", "\n", trim($file->read())));
		$file->close();

		$columns = explode('|', array_shift($contents));

		$rows = [];
		foreach ($contents as $values) {

			$row = array_combine($columns, explode('|', $values));

			$query = $this->Currencies->find('all', [
    			'conditions' => ['code' => $row['code']]
			]);
			$currency = $query->first();

			if (empty($currency)) {

				$currency = $this->Currencies->newEntity();
			}

			$row['original_name'] = $row['name'];
			$row['name'] = ucwords(preg_replace('/-/', ' ', substr($row['slug'], 4)));
			$name = explode(' ', $row['name']);
			$row['short_name'] = $name[count($name) - 1];

			$row['symbol_decimal'] = '&#' . implode(';&#', explode(', ', $row['symbol_decimal'])) . ';';
			$row['symbol_hex'] = '&#x' . implode(';&#x', explode(', ', $row['symbol_hex'])) . ';';

			if (!$row['symbol']) {
				$row['symbol'] = $row['symbol_name'] ? $row['symbol_name'] : $row['symbol_hex'];
			}

			$currency = $this->Currencies->patchEntity($currency, $row);
			$this->Currencies->save($currency);
		}
	}
}

//echo "<pre>\n\nData" . print_r($currency->toArray(), true) . "\n</pre>\n\n";
//exit();
