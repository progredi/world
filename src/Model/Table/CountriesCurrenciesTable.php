<?php

namespace World\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
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

		$this->table('world_countries_currencies');
	}
}