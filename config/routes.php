<?php

use Cake\Routing\Router;

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

Router::defaultRouteClass('DashedRoute');

Router::prefix('admin', function ($routes) {

	$routes->redirect('/world',
		['plugin' => 'World', 'controller' => 'World', 'action' => 'dashboard'],
		['status' => 301]
	);

	$routes->plugin('World', function ($routes) {

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
