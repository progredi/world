<?php

namespace Progredi\World\Model\Table;

//use Cake\ORM\Query;
//use Cake\ORM\RulesChecker;
//use Cake\Validation\Validator;
use Progredi\World\Model\Table\AppTable;

/**
 * Continents Table
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
class CountriesCurrenciesTable extends AppTable
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

		$this->setTable('world_countries_currencies');
	}
}