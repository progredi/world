<?php

namespace World\Model\Table;

use Cake\Cache\Cache;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use World\Model\Table\AppTable;

/**
 * Continents Table
 *
 * PHP5
 *
 * @category  Model\Table
 * @package   CakePHP World Plugin
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2016 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-world-plugin
 */
class ContinentsTable extends AppTable
{
	/**
	 * Initialize method
	 *
	 * @param array $config Configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config)
	{
		parent::initialize($config);

		$this->table('world_continents');

		// Associations

		$this->hasMany('Countries', [
			'className' => 'World.Countries',
			'foreignKey' => 'continent_id',
			'sort' => ['Countries.name' => 'asc'],
			'dependent' => false
		]);
		$this->hasMany('Regions', [
			'className'   => 'World.Regions',
			'foreignKey'  => 'continent_id',
			'sort' => ['Regions.name' => 'asc'],
			'dependent'   => false
		]);
	}

	/**
	 * ValidationDefault method
	 *
	 * @param object $validator
	 * @access public
	 */
	public function validationDefault(Validator $validator)
	{
        $validator
            ->add('name', 'notEmpty', [
                'rule' => 'notEmpty',
                'message' => __('Field cannot be left blank'),
            ]);

		return $validator;
	}

	/**
	 * Options method
	 *
	 * @access public
	 * @return array Select options list of world continents
	 */
	public function options()
	{
		$continents = $this;
		return Cache::remember('world_continents_options', function () use ($continents) {

			$query = $continents->find('list')
				->select(['id', 'name'])
				->where(['enabled' => true])
				->order(['name' => 'asc']);

			return $query->toArray();
		});
    }
}