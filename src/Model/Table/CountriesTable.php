<?php
namespace Progredi\World\Model\Table;

use Cake\Cache\Cache;
//use Cake\ORM\Query;
//use Cake\ORM\RulesChecker;
//use Cake\Validation\Validator;
use Progredi\World\Model\Table\AppTable;

/**
 * Countries Table
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
class CountriesTable extends AppTable
{
    public $order = 'Country.name ASC';

    /**
     * Initialize method
     *
     * @param array $config Configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('world_countries');

        // Associations

        $this->belongsTo('Regions', [
            'className' => 'Progredi/World.Regions',
            'foreignKey' => 'region_id'
        ]);
        $this->belongsTo('Continents', [
            'className' => 'Progredi/World.Continents',
            'foreignKey' => 'continent_id'
        ]);
        //$this->belongsToMany('PostalZones', [
        //	'className' => 'World.PostalZone',
        //	'joinTable' => 'world_countries_postal_zones',
        //	'with' => 'World.CountriesPostalZone',
        //	'foreignKey' => 'country_id',
        //	'associationForeignKey' => 'postal_zone_id',
        //	'unique' => true
        //]);
    }

    /**
     * Model Schema
     *
     * Additional data

    `Code` char(3) NOT NULL DEFAULT '',
    `Name` char(52) NOT NULL DEFAULT '',
    `Continent` enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') NOT NULL DEFAULT 'Asia',
    `Region` char(26) NOT NULL DEFAULT '',
    `SurfaceArea` float(10,2) NOT NULL DEFAULT '0.00',
    `IndepYear` smallint(6) DEFAULT NULL,
    `Population` int(11) NOT NULL DEFAULT '0',
    `LifeExpectancy` float(3,1) DEFAULT NULL,
    `GNP` float(10,2) DEFAULT NULL,
    `GNPOld` float(10,2) DEFAULT NULL,
    `LocalName` char(45) NOT NULL DEFAULT '',
    `GovernmentForm` char(45) NOT NULL DEFAULT '',
    `HeadOfState` char(60) DEFAULT NULL,
    `Capital` int(11) DEFAULT NULL,
    `Code2` char(2) NOT NULL DEFAULT '',
     */

    /**
     * Model Validation
     *
     * @var array
     * @access public
    public $validate = [
        'name' => [
            'rule' => 'notBlank',
            'message' => 'This field cannot be left blank'
        ],
        'code' => [
            'rule' => 'notBlank',
            'message' => 'This field cannot be left blank'
        ],
        'email' => [
            'rule' => 'notBlank',
            'message' => 'This field cannot be left blank'
        ],
        'email' => [
            'rule' => 'email',
            'message' => 'E-mail address not in recognised format',
            'allowEmpty' => false,
        ],
    ];
     */

    /**
     * Options method
     *
     * @access public
     * @return array Options list for countries select input
     */
    public function options()
    {
        $countries = $this;
        return Cache::remember('world_countries_options', function () use ($countries) {

            $query = $countries->find('list')
                ->select(['id', 'name'])
                ->where(['enabled' => true])
                ->order(['name' => 'asc']);

            return $query->toArray();
        });
    }
}
