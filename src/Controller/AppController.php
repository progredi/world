<?php

namespace Progredi\World\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\Network\Session;

/**
 * World AppController
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
class AppController extends BaseController
{
    /**
     * Helpers
     *
     * @var array
     * @access public
     */
    public $helpers = [
        'Html' => ['templates' => 'templates']
    ];

    /**
     * initialize()
     *
     * @access public
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Flash');
        $this->loadComponent('Paginator');
    }
}
