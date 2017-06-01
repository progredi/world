<?php

/**
 * Country Admin View Template
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
		[__('Countries'), __('Countries Dashboard'), ['action' => 'index']],
		[null, null, []]
	]
]); ?>

<h1><?= __('View Country'); ?>: <strong><?= h($country->name); ?></strong></h1>

<div class="country view">

<div class="ui top attached tabular menu">
<a class="active item" data-tab="country"><?= __('Country'); ?></a>
<a class="item" data-tab="region"><?= __('Region'); ?></a>
<a class="item" data-tab="continent"><?= __('Continent'); ?></a>
<a class="item" data-tab="currencies"><?= __('Currencies'); ?></a>
<a class="item" data-tab="languages"><?= __('Languages'); ?></a>
</div>

<!--[ COUNTRY ]-->

<div class="ui bottom attached active tab segment" data-tab="country">

<div class="ui three column stackable grid">
<div class="six wide column">

<h2><?= __('Details'); ?></h2>

<p class="view"><span class="label"><?= __('Name'); ?>: </span><span class="value"><?=
	h($country->name);
?></span></p>

<p class="view"><span class="label"><?= __('Region'); ?>: </span><span class="value"><?=
	h($country->region->name);
?></span></p>

<p class="view"><span class="label"><?= __('Continent'); ?>: </span><span class="value"><?=
	h($country->region->continent->name);
?></span></p>

<div class="ui hidden divider"></div>

<p class="view"><span class="label"><?= __('Official Name'); ?>: </span><span class="value"><?=
	h($country->official_name);
?></span></p>

<p class="view"><span class="label"><?= __('Demonym'); ?>: </span><span class="value"><?=
	h($country->demonym);
?></span></p>

</div>
<div class="five wide column">

<h2><?= __('Codes'); ?></h2>

<p class="view"><span class="label"><?= __('Alpha 3'); ?>: </span><span class="value"><?=
	h($country->alpha_3_code);
?></span></p>

<p class="view"><span class="label"><?= __('Alpha 2'); ?>: </span><span class="value"><?=
	h($country->alpha_2_code);
?></span></p>

<p class="view"><span class="label"><?= __('Numeric'); ?>: </span><span class="value"><?=
	h($country->numeric_code);
?></span></p>

</div>
<div class="five wide column">

<h2><?= __('Location'); ?></h2>

<p class="view"><span class="label"><?= __('Calling Code'); ?>: </span><span class="value"><?=
	h($country->calling_code);
?></span></p>

<p class="view"><span class="label"><?= __('Latitude'); ?>: </span><span class="value"><?=
	h($country->latitude);
?></span></p>

<p class="view"><span class="label"><?= __('Longitude'); ?>: </span><span class="value"><?=
	h($country->longitude);
?></span></p>

</div>
</div>

</div>

<!--[ REGION ]-->

<div class="ui bottom attached tab segment" data-tab="region">

<div class="ui two column stackable grid">
<div class="column">

<h2><?= __('Details'); ?></h2>

<p class="view"><span class="label"><?= __('Name'); ?>: </span><span class="value"><?=
	h($country->region->name);
?></span></p>

</div>
<div class="column">

<?//=  ?>

</div>
</div>

</div>

<!--[ CONTINENT ]-->

<div class="ui bottom attached tab segment" data-tab="continent">

<div class="ui two column stackable grid">
<div class="column">

<h2><?= __('Details'); ?></h2>

<p class="view"><span class="label"><?= __('Name'); ?>: </span><span class="value"><?=
	h($country->region->continent->name);
?></span></p>

</div>
<div class="column">

<?//=  ?>

</div>
</div>

</div>

<!--[ CURRENCIES ]-->

<div class="ui bottom attached tab segment" data-tab="currencies">

<div class="ui one column grid">
<div class="column">

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
</div>

</div>

<!--[ LANGUAGES ]-->

<div class="ui bottom attached tab segment" data-tab="languages">

<div class="ui one column grid">
<div class="column">

<table class="ui striped table">

<thead>

<tr>
<th class="name"><?= __('Name'); ?></th>
<th class="center aligned status"><?= __('Status'); ?></th>
<th class="three action icons"><?= __('Actions'); ?></th>
</tr>

</thead>

<tbody>

<?php if (empty($languages)) : ?>
<tr>
<td colspan="3"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($languages as $language): ?>
<tr>
<td><?= h($language->name); ?></td>
<td class="center aligned status"><?=

$language->enabled ?
	$this->Html->link('<i class="large enabled icon"></i>',
		['action' => 'disable', $language->id],
		['title' => __('Language enabled: click to disable'), 'escape' => false]) :
	$this->Html->link('<i class="large disabled icon"></i>',
		['action' => 'enable', $language->id],
		['title' => __('Language disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

$this->Html->link('<i class="large view record icon"></i>',
	['action' => 'view', $language->id],
	['title' => 'View language', 'escape' => false]);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
	['action' => 'edit', $language->id],
	['title' => 'Edit language', 'escape' => false]);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
	['action' => 'delete', $language->id],
	['title' => __('Delete language'), 'confirm' => __('Are you sure?'), 'escape' => false]);

?></td>
</tr>

<?php endforeach; ?>
<?php endif; ?>
<tbody>

</table>

</div>
</div>

</div>

<?= $this->element('Admin/View/buttons'); ?>

</div>
