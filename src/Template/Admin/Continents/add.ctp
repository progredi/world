<?php

/**
 * Continent Add Template
 *
 * PHP5
 *
 * @category  Template
 * @package   CakePHP World Plugin
 * @version   0.1.0
 * @author    David Scott <support@progredi.co.uk>
 * @copyright Copyright (c) 2014-2016 Progredi
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * @link      http://www.progredi.co.uk/cakephp/plugins/cakephp-world-plugin
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

<h1><?= __('Add Continent'); ?></h1>

<div class="continent add form">

<?= $this->Form->create($continent, ['class' => 'ui form']); ?>

<?= $this->element('Admin/Continents/form'); ?>

<?= $this->element('Admin/Form/Add/buttons'); ?>

<?= $this->Form->end(); ?>

</div>