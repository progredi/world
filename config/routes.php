<?php

use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * Routes
 *
 * @category  Config
 * @package   Progredi\World
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2017 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link      https://github.com/progredi/world
 */

Router::defaultRouteClass(DashedRoute::class);

Router::prefix('admin', function (RouteBuilder $routes) {

    $routes->redirect('/world',
        ['plugin' => 'Progredi/World', 'controller' => 'World', 'action' => 'dashboard'],
        ['status' => 301]
    );

    $routes->plugin('Progredi/World', ['path' => '/world'], function (RouteBuilder $routes) {

        $routes->extensions(['json', 'xml']);

        $routes->connect('/dashboard',
            ['controller' => 'World', 'action' => 'dashboard']
        );

        $routes->connect('/:controller',
            ['action' => 'index']
        );
        $routes->connect('/:controller/:action',
            []
        );
        $routes->connect('/:controller/:action/:id',
            [],
            ['pass' => ['id'], 'id' => '[0-9]+']
        );
    });
});
