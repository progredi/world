<?php

namespace Progredi\World\Controller\Admin;

use Cake\Network\Session;
use Progredi\World\Controller\Admin\AppController;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;

/**
 * Continents Admin Controller
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
class ContinentsController extends AppController
{
    /**
     * Index method [Admin]
     *
     * @return \Cake\Http\Response|void Redirects, otherwise renders list view.
     */
    public function index()
    {
        // Configure pagination request.

        $this->paginate['Continents'] = [
            'conditions' => parent::index(),
            //'fields' => ['Continents.id', 'Continents.name', 'Continents.enabled'],
            'limit' => $this->paginate['limit'],
            'order' => ['Continents.name' => 'asc'],
            'contain' => [
                'Regions',
                'Countries'
            ]
        ];

        // Check for invalid pagination requests.

        try {
            $continents = $this->paginate($this->Continents);
        }
        catch (NotFoundException $e) {

            // Check for out of range page request.

            $this->Flash->error(__("Page request out of range"));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('title_for_layout', __('Continents') . TS . __('World'));

        $this->set('continents', $continents);
        $this->set('_serialize', ['continents']);
    }

    /**
     * Add method [Admin]
     *
     * @return \Cake\Http\Response|void Redirects on successful add, otherwise renders view.
     */
    public function add()
    {
        $continent = $this->Continents->newEntity();

        $session = $this->request->session();

        if ($this->request->is('post')) {
            $continent = $this->Continents->patchEntity($continent, $this->request->getData());
            if ($this->Continents->save($continent)) {
                $this->Flash->success(__('Continent details have been saved'));
                if (isset($this->request->getData['Continent.apply'])) {
                    return $this->redirect(['action' => 'edit', $this->Continents->id]);
                }
                return $this->redirect($session->read('App.referrer'));
            }
            $this->Flash->error(__('Continent details could not be saved, please try again'));
        }

        if (!$this->request->data) {
            $session->write('App.referrer', $this->referer());
        }

        $this->set('title_for_layout', __('Add Continent') . TS . __('Continents') . TS . __('World'));

        $this->set(compact('continent'));
        $this->set('_serialize', ['continent']);
    }

    /**
     * View method [Admin]
     *
     * @param string|null $id Country id. Can be null for testing purposes.
     * @return \Cake\Http\Response|void Redirects on failed entity retrieval, renders view otherwise.
     */
    public function view($id = null)
    {
        // Check for entity request errors.

        try {
            $continent = $this->Continents->get($id, [
                'contain' => [
                    'Regions' => [
                        'Countries'
                    ],
                    'Countries' => [
                        'Regions'
                    ],
                ]
            ]);
        }
        catch (RecordNotFoundException $e) {

            // Record primary key not found in table.

            $this->Flash->error(__('Continent not found'));
            return $this->redirect(['action' => 'index']);
        }
        catch (InvalidPrimaryKeyException $e) {

            // Invalid primary key, e.g. NULL.

            $this->Flash->error(__("Invalid record id specified"));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('title_for_layout', __('View Continent') . TS . __('Continents') . TS . __('World'));

        $session = $this->request->session();
        $session->write('App.referrer', $this->referer());

        $this->set('continent', $continent);
        $this->set('_serialize', ['continent']);
    }

    /**
     * Edit method [Admin]
     *
     * @param string|null $id Continent id. Can be null for testing purposes.
     * @return void Redirects on failed entity retrieval, renders view otherwise.
     */
    public function edit($id = null)
    {
        // Check for entity request errors.

        try {
            $continent = $this->Continents->get($id);
        } catch (RecordNotFoundException $e) {
            // Record primary key not found in table.
            $this->Flash->error(__('Continent not found'));
            return $this->redirect(['action' => 'index']);
        } catch (InvalidPrimaryKeyException $e) {
            // Invalid primary key, e.g. NULL.
            $this->Flash->error(__("Invalid record id specified"));
            return $this->redirect(['action' => 'index']);
        }

        $session = $this->request->session();

        if ($this->request->is(['post', 'put'])) {
            $continent = $this->Continents->patchEntity($continent, $this->request->getData());
            if ($this->Continents->save($continent)) {
                $this->Flash->success(__('Continent details haves been updated'));
                if (!isset($this->request->data['apply'])) {
                    return $this->redirect($session->read('App.referrer'));
                }
            } else {
                $this->Flash->error(__('Continent details could not be updated, please try again'));
            }
        }

        if (is_null($this->request->getData())) {
            $this->request->setData($continent);
            $session->write('App.referrer', $this->referer());
        }

        $this->set('title_for_layout', __('Edit Continent') . TS . __('Continents') . TS . __('World'));

        $this->set('continent', $continent);
        $this->set('_serialize', ['continent']);
    }

    /**
     * Delete method [Admin]
     *
     * @param string|null $id Continent id. Can be null for testing purposes.
     * @return \Cake\Http\Response
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        // Check for entity request errors.

        try {
            $continent = $this->Continents->get($id);
        }
        catch (RecordNotFoundException $e) {

            // Record primary key not found in table.

            $this->Flash->error(__('Continent not found'));
            return $this->redirect(env('HTTP_REFERER'));
        }
        catch (InvalidPrimaryKeyException $e) {

            // Invalid primary key, e.g. NULL.

            $this->Flash->error(__("Invalid record id specified"));
            return $this->redirect(env('HTTP_REFERER'));
        }

        if ($this->Continents->delete($continent)) {
            $this->Flash->success(__('Continent has been deleted'));
        } else {
            $this->Flash->error(__('Continent could not be deleted, please try again'));
        }

        return $this->redirect(preg_match('/view|edit/', env('HTTP_REFERER'))
            ? ['action' => 'index']
            : env('HTTP_REFERER')
        );
    }
}

//echo "<pre>\n\nData" . print_r($continent->toArray(), true) . "\n</pre>\n\n";
//exit();
