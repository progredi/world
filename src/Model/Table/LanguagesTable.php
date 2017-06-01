<?php

namespace Progredi\World\Model\Table;

use Cake\Cache\Cache;
//use Cake\ORM\Query;
//use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;
use Progredi\World\Model\Table\AppTable;

/**
 * Languages Table
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
class LanguagesTable extends AppTable
{
    /**
     * Initialize method
     *
     * @param array $config Configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->setTable('world_languages');

        // Table Associations

        $this->hasMany('Countries', [
            'className'   => 'World.Countries',
            'foreignKey'  => 'continent_id',
            'dependent'   => false
        ]);
        $this->hasMany('Regions', [
            'className'   => 'World.Regions',
            'foreignKey'  => 'continent_id',
            'dependent'   => false
        ]);
    }

    /**
     * ValidationDefault method
     *
     * @access public
     * @param object $validator
     * @return object Validator
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
     * @return array Options list for languages select input
     */
    public function options()
    {
        $languages = $this;
        return Cache::remember('world_languages_options', function () use ($languages) {

            $query = $languages->find('list')
                ->select(['id', 'name'])
                ->where(['enabled' => true])
                ->order(['name' => 'asc']);

            return $query->toArray();
        });
    }
}

//echo "<pre>\n\nSessionData: " . print_r(CakeSession::read(), true) . "\n</pre>\n\n";
//exit();
