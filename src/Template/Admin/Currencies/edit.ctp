<?php

/**
 * Currency Admin Edit Template
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
		[__('Currencies'), __('Currencies Dashboard'), ['action' => 'index']],
		[null, null, []]
	]
]); ?>

<h1><?= __('Edit Currency') . ': <strong>' . h($currency->name) . '</strong>'; ?></h1>

<div class="currency edit form">

<?= $this->Form->create($currency, ['class' => 'ui form']); ?>

<?= $this->Form->hidden('id'); ?>

<?= $this->element('Admin/Currencies/form'); ?>

<?= $this->element('Admin/Form/Edit/buttons'); ?>

<?= $this->Form->end(); ?>

</div>
