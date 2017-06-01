<?php

/**
 * Region Admin Add Template
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

?>
<?= $this->element('navigation/breadcrumbs', [
	'menuItems' => [
		[__('Dashboard'), __('Admin Dashboard'), ['plugin' => null, 'controller' => 'Admin', 'action' => 'dashboard']],
		[__('World'), __('World Dashboard'), ['controller' => 'World', 'action' => 'dashboard']],
		[__('Regions'), __('Regions Dashboard'), ['action' => 'index']],
		[null, null, []]
	]
]); ?>

<h1><?= __('Add Region'); ?></h1>

<div class="add region form">

<?= $this->Form->create($region, ['class' => 'ui form']); ?>

<?= $this->element('Admin/Regions/form'); ?>

<?= $this->element('Admin/Form/Add/buttons'); ?>

<?= $this->Form->end(); ?>

</div>