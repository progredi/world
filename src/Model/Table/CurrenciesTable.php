<?php

namespace Progredi\World\Model\Table;

use Cake\Cache\Cache;
//use Cake\ORM\Query;
//use Cake\ORM\RulesChecker;
//use Cake\Validation\Validator;
//use Progredi\World\Model\Table\AppTable;

/**
 * Currencies Table
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
class CurrenciesTable extends AppTable
{
    public $order = ['Currencies.name' => 'asc'];

    /**
     * Initialize method
     *
     * @param array $config Configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('world_currencies');

        // Associations

        $this->belongsToMany('Countries', [
            'className' => 'World.Countries',
            'joinTable' => 'world_countries_currencies',
            'with' => 'World.Currencies',
            'foreignKey' => 'currency_id',
            'targetForeignKey' => 'country_id',
            'sort' => ['Countries.name' => 'asc'],
            'unique' => 'keepExisting'
        ]);
    }

    /**
     * ValidationDefault method
     *
     * @param object $validator
     * @access public
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('title')
            ->notEmpty('body');

        return $validator;
    }
     */

    /**
     * Options method
     *
     * @access public
     * @return array Options list for currencies select input
     */
    public function options()
    {
        $currencies = $this;
        return Cache::remember('world_currencies_options', function () use ($currencies) {

            $query = $currencies->find('list')
                ->select(['id', 'name'])
                ->where(['enabled' => true])
                ->order(['name' => 'asc']);

            return $query->toArray();
        });
    }
}
