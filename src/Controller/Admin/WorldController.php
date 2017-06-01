<?php

namespace Progredi\World\Controller\Admin;

use Progredi\World\Controller\Admin\AppController;

/**
 * World Controller
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
class WorldController extends AppController
{
    /**
     * Dashboard method
     *
     * @return void
     */
    public function dashboard()
    {
        $this->set('title_for_layout', __('Dashboard') . TS . __('World') . TS . __('Admin'));
    }
}
