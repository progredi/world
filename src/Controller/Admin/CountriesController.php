<?php

namespace Progredi\World\Controller\Admin;

use Cake\Filesystem\File;
use Cake\Network\Session;
use Progredi\World\Controller\Admin\AppController;

use Cake\Datasource\Exception\InvalidPrimaryKeyException;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Network\Exception\NotFoundException;

/**
 * Countries Admin Controller
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
class CountriesController extends AppController
{
    /**
     * Index method [Admin]
     *
     * @return void
     */
    public function index()
    {
        // Check if REST API request

        if (is_null($this->request->getParam['_ext'])) {

            // Configure pagination request.

            $this->paginate['Countries'] = [
                'conditions' => parent::index(),
                'limit' => $this->paginate['limit'],
                'order' => [
                    'Countries.name' => 'asc'
                ],
                'contain' => [
                    'Regions' => [
                        'Continents'
                    ]
                ],
                'sortWhitelist' => [
                    'Countries.name',
                    'Regions.name',
                    'Continents.name',
                    'Countries.enabled'
                ]
            ];

            // Check for invalid pagination requests.

            try {
                $countries = $this->paginate($this->Countries);
            }
            catch (NotFoundException $e) {

                // Check for out of range page request.

                $this->Flash->error(__("Page request out of range"));
                return $this->redirect(['action' => 'index']);
            }

            $this->set('title_for_layout', __('Countries') . TS . __('World'));
            $this->set('countries', $countries);
        }
        else {

            $countries = $this->Countries->find('all')
                ->order(['name' => 'asc']);

            $this->set('countries', $countries);
            $this->set('_serialize', ['countries']);
        }
    }

    /**
     * Add method [Admin]
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $country = $this->Countries->newEntity();

        $session = $this->request->session();

        if ($this->request->is('post')) {
            $country = $this->Countries->patchEntity($country, $this->request->data);
            if ($this->Countries->save($country)) {
                $this->Flash->success(__('Country details have been saved'));
                if (isset($this->request->data['apply'])) {
                    return $this->redirect(['action' => 'edit', $this->Countries->id]);
                }
                return $this->redirect($session->read('App.referrer'));
            }
            $this->Flash->error(__('Country details could not be saved, please try again'));
        }

        if (!$this->request->data) {
            $session->write('App.referrer', $this->referer());
        }

        $this->set('title_for_layout', __('Add Country') . TS . __('World'));

        $this->set('country', $country);
        $this->set('regionsOptions', $this->Countries->Regions->options());
    }

    /**
     * View method [Admin]
     *
     * @param string|null $id Country id. Can be null for testing purposes.
     * @return void Redirects on failed entity retrieval, renders view otherwise.
     */
    public function view($id = null)
    {
        // Check for entity request errors.

        try {
            $country = $this->Countries->get($id, [
                'contain' => [
                    'Regions' => [
                        'Continents'
                    ]
                ]
            ]);
        }
        catch (RecordNotFoundException $e) {

            // Record primary key not found in table.

            $this->Flash->error(__('Country not found'));
            return $this->redirect(['action' => 'index']);
        }
        catch (InvalidPrimaryKeyException $e) {

            // Invalid primary key, e.g. NULL.

            $this->Flash->error(__("Invalid record id specified"));
            return $this->redirect(['action' => 'index']);
        }

        $this->set('title_for_layout', __('View Country') . TS . __('World'));

        $session = $this->request->session();
        $session->write('App.referrer', $this->referer());

        $this->set('country', $country);
        $this->set('_serialize', ['country']);
    }

    /**
     * Edit method [Admin]
     *
     * @param string|null $id Country id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        // Check for entity request errors.

        try {
            $country = $this->Countries->get($id);
        }
        catch (RecordNotFoundException $e) {

            // Record primary key not found in table.

            $this->Flash->error(__('Country not found'));
            return $this->redirect(['action' => 'index']);
        }
        catch (InvalidPrimaryKeyException $e) {

            // Invalid primary key, e.g. NULL.

            $this->Flash->error(__("Invalid record id specified"));
            return $this->redirect(['action' => 'index']);
        }

        $session = $this->request->session();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $country = $this->Countries->patchEntity($country, $this->request->data);
            if ($this->Countries->save($country)) {
                $this->Flash->success(__('Country details have been updated'));
                if (!isset($this->request->data['apply'])) {
                    return $this->redirect($session->read('App.referrer'));
                }
            } else {
                $this->Flash->error(__('Country details could not be updated, please try again'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $country;
            $session->write('App.referrer', $this->referer());
        }

        $this->set('title_for_layout', __('Edit Country') . TS . __('World'));

        $this->set('country', $country);
        $this->set('_serialize', ['country']);

        $this->set('regionsOptions', $this->Countries->Regions->options());
    }

    /**
     * Delete method [Admin]
     *
     * @param int|null $id Country id.
     * @return void Redirects to referrer or index method
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        // Check for entity request errors.

        try {
            $country = $this->Countries->get($id);
        }
        catch (RecordNotFoundException $e) {

            // Record primary key not found in table.

            $this->Flash->error(__('Country not found'));
            return $this->redirect(env('HTTP_REFERER'));
        }
        catch (InvalidPrimaryKeyException $e) {

            // Invalid primary key, e.g. NULL.

            $this->Flash->error(__("Invalid record id specified"));
            return $this->redirect(env('HTTP_REFERER'));
        }

        if ($this->Countries->delete($country)) {
            $this->Flash->success(__('Country has been deleted'));
        } else {
            $this->Flash->error(__('Country could not be deleted, please try again'));
        }

        return $this->redirect(preg_match('/view|edit/', env('HTTP_REFERER'))
            ? ['action' => 'index']
            : env('HTTP_REFERER')
        );
    }

    /**
     * Import method [Admin]
     *
     * @return void
     */
    public function import()
    {
        $file = new File(TMP . 'countries.json');
        $contents = json_decode($file->read(), true);
        $file->close();

        $countries = ['missing' => [], 'present' => []];
        foreach ($contents as $entry) {

            $query = $this->Countries->find('all', [
                'conditions' => ['alpha_3_code' => $entry['cca3']]
            ]);
            $country = $query->first();

            if (empty($country)) {
                $countries['missing'][] = $entry;
                continue;
            }

            $data = [
                'official_name' => $entry['name']['official'] ? $entry['name']['official'] : null,
                'demonym' => $entry['demonym'] ? $entry['demonym'] : null,
                'alpha2_code' => $entry['cca2'] ? $entry['cca2'] : null,
                'numeric_code' => $entry['ccn3'] ? $entry['ccn3'] : null,
                'calling_code' => !empty($entry['callingCode']) ? implode(', ', $entry['callingCode']) : null,
                'latitude' => !empty($entry['latlng']) ? $entry['latlng'][0] : null,
                'longitude' => !empty($entry['latlng']) ? $entry['latlng'][1] : null
            ];

            $country = $this->Countries->patchEntity($country, $data);
            $this->Countries->save($country);
        }

        $this->set('countries', $countries);
        $this->set('_serialize', ['countries']);
    }
}

//echo "<pre>\n\nData" . print_r($country->toArray(), true) . "\n</pre>\n\n";
//exit();
//echo "<pre>\n\nData" . print_r($this->request, true) . "\n</pre>\n\n";
//exit();
