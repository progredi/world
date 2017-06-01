<?php

use Cake\Core\Configure;

/**
 * Currency Admin List Template
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
		[__('Currencies'), __('Currencies Dashboard'), ['action' => 'index']]
	]
]); ?>

<h1 class="ui large header"><?= __('Currencies'); ?></h1>

<div class="ui stackable grid">
<div class="mobile only four wide column">

<!--[ ACTIONS + SEARCH FILTER ]-->

<div class="ui grid">
<div class="sixteen wide column">

<?= $this->Html->link('<i class="plus icon"></i> Currency',
	['action' => 'add'],
	['class' => 'ui add button', 'title' => __('Add a new currency'), 'escape' => false]
); ?>

</div>
<div class="sixteen wide column">

<?= $this->element('search-filter', [
	'columns' => ['id', 'name'],
	'default' => 'postcode'
]); ?>

</div>
</div>

</div>
<div class="twelve wide column">

<!--[ CURRENCIES LIST ]-->

<div class="ui grid">

<div class="sixteen wide column">

<table class="ui striped table">

<thead>

<tr>
<th class="name"><?= __('Name'); ?></th>
<th><?= __('Code'); ?></th>
<th><?= __('Symbol'); ?></th>
<th><?= __('EX Rate'); ?></th>
<th class="center aligned status"><?= __('Status'); ?></th>
<th class="three action icons"><?= __('Actions'); ?></th>
</tr>

</thead>

<tbody>

<?php if (empty($currencies)) : ?>
<tr>
<td colspan="6"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($currencies as $currency): ?>
<tr>
<td><?= h($currency->name); ?></td>
<td><?= h($currency->code); ?></td>
<td><?= $currency->symbol; ?></td>
<td><?= h($currency->exchange_rate); ?></td>
<td class="center aligned status"><?=

$currency->enabled ?
	$this->Html->link('<i class="large enabled icon"></i>',
		['action' => 'disable', $currency->id],
		['title' => __('Currency enabled: click to disable'), 'escape' => false]) :
	$this->Html->link('<i class="large disabled icon"></i>',
		['action' => 'enable', $currency->id],
		['title' => __('Currency disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

$this->Html->link('<i class="large view record icon"></i>',
	['action' => 'view', $currency->id],
	['title' => 'View currency', 'escape' => false]);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
	['action' => 'edit', $currency->id],
	['title' => 'Edit currency', 'escape' => false]);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
	['action' => 'delete', $currency->id],
	['title' => __('Delete currency'), 'confirm' => __('Are you sure?'), 'escape' => false]);

?></td>
</tr>

<?php endforeach; ?>
<?php endif; ?>
<tbody>

</table>

</div>

<div class="row">
<div class="column">

<?= $this->element('navigation/pagination'); ?>

</div>
</div>

</div>

</div>
<div class="small monitor only large monitor only four wide column">

<!--[ ACTIONS + SEARCH FILTER ]-->

<div class="ui grid">
<div class="sixteen wide column">

<?= $this->Html->link('<i class="plus icon"></i> Currency',
	['action' => 'add'],
	['class' => 'ui add button', 'title' => __('Add a new currency'), 'escape' => false]
); ?>

</div>
<div class="sixteen wide column">

<?= $this->element('search-filter', [
	'columns' => ['id', 'name'],
	'default' => 'postcode'
]); ?>

</div>
</div>

</div>
</div>
