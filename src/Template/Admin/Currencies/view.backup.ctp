<?php

/**
 * Currency View Template
 *
 * PHP5/7
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
		[__('Dashboard'), __('Admin Dashboard'), ['plugin' => 'ProgrediApp', 'controller' => 'Dashboard', 'action' => 'index']],
		[__('World'), __('World Dashboard'), ['controller' => 'World', 'action' => 'dashboard']],
		[__('Currencies'), __('Currencies Dashboard'), ['action' => 'index']],
		[null, null, []]
	]
]); ?>

<h1><?= __('View Currency') . ': <strong>' . h($currency->name) . '</strong>'; ?></h1>

<div class="currency view">

<div class="tabbedPanels">

<ul class="tabs">
<li><a class="selected" href="#currency"><?= __('Currency'); ?></a></li>
<li><a class="selected" href="#countries"><?= __('Countries'); ?></a></li>
</ul>

<!-- [ CURRENCY ]-->

<div id="currency" class="clearfix panel">

<div class="colspan_6 alpha">

<h2><?= __('Details'); ?></h2>

<p class="view"><span class="label">Name: </span><span class="value"><?=
	h($currency->name);
?></span></p>

<p class="view"><span class="label">Code: </span><span class="value"><?=
	h($currency->code);
?></span></p>

<p class="view"><span class="label">Symbol: </span><span class="value"><?=
	$currency->symbol;
?></span></p>

<p class="view"><span class="label">Exchange Rate: </span><span class="value"><?=
	h($currency->exchange_rate);
?></span></p>

</div>

<div class="colspan_6 omega">

<br><br><br>

<p class="view"><span class="label">Decimal Point: </span><span class="value"><?=
	h($currency->decimal_point);
?></span></p>

<p class="view"><span class="label">Thousands Point: </span><span class="value"><?=
	h($currency->thousands_point);
?></span></p>

<p class="view"><span class="label">Decimal Places: </span><span class="value"><?=
	h($currency->decimal_places);
?></span></p>

</div>

</div>

<!-- [ COUNTRIES ]-->

<div id="countries" class="clearfix panel">

<table class="ui striped table">

<thead>

<tr>
<th class="name" colspans="2"><?= __('Name'); ?></th>
<th class="centered status"><?= __('Status');?></th>
<th class="three icons actions"><?= __('Actions');?></th>
</tr>

</thead>

<tbody>

<?php if (!$currency->countries) : ?>
<tr>
<td colspan="4"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($currency->countries as $country): ?>
<tr>
<td><?= '<i class="' . strtolower(h($country->alpha_2_code)) . ' flag" styles="margin:0"></i>'; ?> <?= h($country->name); ?></td>
<td class="centered status"><?=

$country->enabled ?
	$this->Html->link('<i class="large enabled icon"></i>',
		['action' => 'disable', $country->id],
		['title' => __('Country is enabled: click to disable'), 'escape' => false]) :
	$this->Html->link('<i class="large disabled icon"></i>',
		['action' => 'enable', $country->id],
		['title' => __('Country is disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three icons actions"><?=

$this->Html->link('<i class="large view record icon"></i>',
	['action' => 'view', $country->id],
	['title' => __('View country'), 'escape' => false]
);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
	['action' => 'edit', $country->id],
	['title' => __('Edit country'), 'escape' => false]
);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
	['action' => 'delete', $country->id],
	['title' => __('Delete country'), 'confirm' => __('Are you sure?'), 'escape' => false]
);

?></td>
</tr>

<?php endforeach; ?>
<?php endif; ?>
</tbody>

</table>

<?/*= $this->Html->link('Add',
	['controller' => 'Countries', 'action' => 'add', $currency->id],
	['class' => 'ui add button', 'title' => __('Add country'),  'style' => 'margin-top:1.7em;']
); */?>

</div>

</div>

<?= $this->element('Admin/View/buttons'); ?>

</div>
