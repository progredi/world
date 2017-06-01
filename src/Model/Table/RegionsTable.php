<?php

namespace Progredi\World\Model\Table;

use Cake\Cache\Cache;
//use Cake\ORM\Query;
//use Cake\ORM\RulesChecker;
//use Cake\Validation\Validator;
use Progredi\World\Model\Table\AppTable;

/**
 * Regions Table
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
class RegionsTable extends AppTable
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

		$this->setTable('world_regions');

		// Associations

		$this->hasMany('Countries', [
			'className'   => 'World.Countries',
			'foreignKey'  => 'region_id',
			'sort' => ['Countries.name' => 'asc'],
			'dependent'   => false
		]);
		$this->belongsTo('Continents', [
			'className' => 'World.Continents',
			'foreignKey' => 'continent_id'
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
            ->add('name', 'notBlank', [
                'rule' => 'notBlank',
                'message' => __('Field cannot be left blank'),
            ]);

		return $validator;
	}

	/**
	 * Options method
	 *
	 * @access public
     * @return array Options list for regions select input
	 */
	public function options()
	{
		$regions = $this;
		return Cache::remember('world_regions_options', function () use ($regions) {

			$query = $regions->find('list')
				->select(['id', 'name'])
				->where(['enabled' => true])
				->order(['name' => 'asc']);

			return $query->toArray();
		});
    }
}
