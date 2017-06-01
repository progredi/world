<?php

/**
 * Continent Admin Edit Template
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
		[__('Continents'), __('Continents Dashboard'), ['action' => 'index']],
		[null, null, []]
	]
]); ?>

<h1><?= __('Edit Continent'); ?>: <strong><?= h($continent->name); ?></strong></h1>

<div class="continent edit form">

<?= $this->Form->create($continent, ['class' => 'ui form']); ?>

<?= $this->Form->hidden('id'); ?>

<?= $this->element('Admin/Continents/form'); ?>

<?= $this->element('Admin/Form/Edit/buttons'); ?>

<?= $this->Form->end(); ?>

</div>