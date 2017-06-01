<?php

/**
 * Continent Admin View Template
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

<h1><?= __('View Continent'); ?>: <strong><?= h($continent->name); ?></strong></h1>

<div class="continent view">

<div class="ui top attached tabular menu">
<a class="active item" data-tab="continent">Continent</a>
<a class="item" data-tab="regions">Regions</a>
<a class="item" data-tab="countries">Countries</a>
</div>

<!--[ CONTINENT ]-->

<div class="ui bottom attached active tab segment" data-tab="continent">

<div class="ui two column stackable grid">
<div class="column">

<h2><?= __('Details'); ?></h2>

<p class="view"><span class="label"><?= __('Name'); ?>: </span><span class="value"><?=
	h($continent->name);
?></span></p>

</div>
<div class="column">

<?//=  ?>

</div>
</div>

</div>

<!--[ REGIONS ]-->

<div class="ui bottom attached tab segment" data-tab="regions">

<table class="ui striped table">

<thead>

<tr>
<th><?= __('Name'); ?></th>
<th class="center aligned"><?= __('Countries'); ?></th>
<th class="center aligned status"><?= __('Status');?></th>
<th class="three action icons"><?= __('Actions');?></th>
</tr>

</thead>

<tbody>

<?php if (!$continent->regions) : ?>
<tr>
<td colspan="4"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($continent->regions as $region) : ?>
<tr>
<td><?= h($region->name); ?></td>
<td class="center aligned"><?= count($region->countries); ?></td>
<td class="center aligned status"><?=

$region->enabled ?
	$this->Html->link('<i class="large enabled icon"></i>',
		['controller' => 'Regions', 'action' => 'disable', $region->id],
		['title' => __('Region is enabled: click to disable'), 'escape' => false]) :
	$this->Html->link('<i class="large disabled icon"></i>',
		['controller' => 'Regions', 'action' => 'enable', $region->id],
		['title' => __('Region is disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

$this->Html->link('<i class="large view record icon"></i>',
	['controller' => 'Regions', 'action' => 'view', $region->id],
	['title' => __('View region'), 'escape' => false]
);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
	['controller' => 'Regions', 'action' => 'edit', $region->id],
	['title' => __('Edit region'), 'escape' => false]
);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
	['controller' => 'Regions', 'action' => 'delete', $region->id],
	['title' => __('Delete region'), 'confirm' => __('Are you sure?'), 'escape' => false]
);

?></td>
</tr>

<?php endforeach; ?>
<?php endif; ?>
</tbody>

</table>

<?= $this->Html->link('Add',
	['controller' => 'Regions', 'action' => 'add', $continent->id],
	['class' => 'ui add button', 'title' => __('Add region'),  'style' => 'margin-top:1.7em;']
); ?>

</div>

<!--[ COUNTRIES ]-->

<div class="ui bottom attached tab segment" data-tab="countries">

<table class="ui striped table">

<thead>

<tr>
<th><?= __('Name'); ?></th>
<th><?= __('Region'); ?></th>
<th class="center aligned status"><?= __('Status');?></th>
<th class="three action icons"><?= __('Actions');?></th>
</tr>

</thead>

<tbody>

<?php if (!$continent->countries) : ?>
<tr>
<td colspan="4"><?= __('No countries found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($continent->countries as $country) : ?>
<tr>
<td><?= '<i class="' . strtolower(h($country->alpha_2_code)) . ' flag" styles="margin:0"></i>'; ?> <?= h($country->name); ?></td>
<td><?= h($country->region->name); ?></td>
<td class="center aligned status"><?=

$country->enabled ?
	$this->Html->link('<i class="large enabled icon"></i>',
		['controller' => 'Countries', 'action' => 'disable', $country->id],
		['title' => __('Country is enabled: click to disable'), 'escape' => false]) :
	$this->Html->link('<i class="large disabled icon"></i>',
		['controller' => 'Countries', 'action' => 'enable', $country->id],
		['title' => __('Country is disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

$this->Html->link('<i class="large view record icon"></i>',
	['controller' => 'Countries', 'action' => 'view', $country->id],
	['title' => __('View country'), 'escape' => false]
);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
	['controller' => 'Countries', 'action' => 'edit', $country->id],
	['title' => __('Edit country'), 'escape' => false]
);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
	['controller' => 'Countries', 'action' => 'delete', $country->id],
	['title' => __('Delete country'), 'confirm' => __('Are you sure?'), 'escape' => false]
);

?></td>
</tr>

<?php endforeach; ?>
<?php endif; ?>
</tbody>

</table>

</div>

<?= $this->element('Admin/View/buttons'); ?>

</div>
