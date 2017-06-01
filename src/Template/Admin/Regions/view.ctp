<?php

/**
 * Region Admin View Template
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

//debug($region);

?>
<?= $this->element('navigation/breadcrumbs', [
	'menuItems' => [
		[__('Dashboard'), __('Admin Dashboard'), ['plugin' => null, 'controller' => 'Admin', 'action' => 'dashboard']],
		[__('World'), __('World Dashboard'), ['controller' => 'World', 'action' => 'dashboard']],
		[__('Regions'), __('Regions Dashboard'), ['action' => 'index']],
		[null, null, []]
	]
]); ?>

<h1><?= __('View Region'); ?>: <strong><?= h($region->name); ?></strong></h1>

<div class="region view">

<div class="ui top attached tabular menu">
<a class="active item" data-tab="region">Region</a>
<a class="item" data-tab="continent">Continent</a>
<a class="item" data-tab="countries">Countries</a>
</div>

<!--[ REGION ]-->

<div class="ui bottom attached active tab segment" data-tab="region">

<div class="ui two column stackable grid">
<div class="column">

<h2><?= __('Details'); ?></h2>

<p class="view"><span class="label"><?= __('Name'); ?>: </span><span class="value"><?=
	h($region->name);
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
	h($region->continent->name);
?></span></p>

</div>
<div class="column">

<?//=  ?>

</div>
</div>

</div>

<!--[ COUNTRIES ]-->

<div class="ui bottom attached tab segment" data-tab="countries">

<table class="ui striped table">

<thead>

<tr>
<th class="name"><?= __('Name'); ?></th>
<th class="center aligned status"><?= __('Status');?></th>
<th class="three action icons"><?= __('Actions');?></th>
</tr>

</thead>

<tbody>

<?php if (!$region->countries) : ?>
<tr>
<td colspan="4"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($region->countries as $country): ?>
<tr>
<td><?= '<i class="' . strtolower(h($country->alpha_2_code)) . ' flag" styles="margin:0"></i>'; ?> <?= h($country->name); ?></td>
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

<?= $this->Html->link('Add',
	['controller' => 'Countries', 'action' => 'add', $region->id],
	['class' => 'ui add button', 'title' => __('Add country')]
); ?>

</div>

<?= $this->element('Admin/View/buttons'); ?>

</div>
