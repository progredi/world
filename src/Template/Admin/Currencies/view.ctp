<?php

/**
 * Currency Admin View Template
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

<h1><?= __('View Currency') . ': <strong>' . h($currency->name) . '</strong>'; ?></h1>

<div class="currency view">

<div class="ui top attached tabular menu">
<a class="active item" data-tab="currency"><?= __('Currency'); ?></a>
<a class="item" data-tab="countries"><?= __('Countries'); ?></a>
</div>

<!--[ CURRENCY ]-->

<div class="ui bottom attached active tab segment" data-tab="currency">

<div class="ui three column stackable grid">
<div class="six wide column">

<h2><?= __('Details'); ?></h2>

<p class="view"><span class="label"><?= __('Name'); ?>: </span><span class="value"><?=
    h($currency->name);
?></span></p>

<p class="view"><span class="label"><?= __('Code'); ?>: </span><span class="value"><?=
    h($currency->code);
?></span></p>

<p class="view"><span class="label"><?= __('Symbol'); ?>: </span><span class="value"><?=
    $currency->symbol;
?></span></p>

<p class="view"><span class="label"><?= __('Exchange Rate'); ?>: </span><span class="value"><?=
    h($currency->exchange_rate);
?></span></p>

</div>
<div class="five wide column">

<h2><?= __('Decimal Format'); ?></h2>

<p class="view"><span class="label" title="Decimal Point"><?= __('Point'); ?>: </span><span class="value"><?=
    h($currency->decimal_point);
?></span></p>

<p class="view"><span class="label" title="Decimal Places"><?= __('Places'); ?>: </span><span class="value"><?=
    h($currency->decimal_places);
?></span></p>

<h2><?= __('Thousands Format'); ?></h2>

<p class="view"><span class="label" title="Thousands Separator"><?= __('Separator'); ?>: </span><span class="value"><?=
    h($currency->thousands_point);
?></span></p>

</div>
<div class="five wide column">

<h2><?= __('Symbols'); ?></h2>

<p class="view"><span class="label" title="HTML Entity Name"><?= __('Name'); ?>: </span><span class="value"><?=
    h($currency->symbol_name);
?></span></p>

<p class="view"><span class="label" title="HTML Entity Decimal"><?= __('Decimal'); ?>: </span><span class="value"><?=
    h($currency->symbol_decimal);
?></span></p>

<p class="view"><span class="label" title="HTML Entity Hex"><?= __('Hex'); ?>: </span><span class="value"><?=
    h($currency->symbol_hex);
?></span></p>

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

<?php if (!$currency->countries) : ?>
<tr>
<td colspan="4"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($currency->countries as $country): ?>
<tr>
<td><?= '<i class="' . strtolower(h($country->alpha_2_code)) . ' flag" styles="margin:0"></i>'; ?> <?= h($country->name); ?></td>
<td class="center aligned status"><?=

$country->enabled ?
    $this->Html->link('<i class="large enabled icon"></i>',
        ['action' => 'disable', $country->id],
        ['title' => __('Country is enabled: click to disable'), 'escape' => false]) :
    $this->Html->link('<i class="large disabled icon"></i>',
        ['action' => 'enable', $country->id],
        ['title' => __('Country is disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

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

<?= $this->Html->link('Add',
    ['controller' => 'CountriesCurrencies', 'action' => 'add', $currency->id],
    ['class' => 'ui add button', 'title' => __('Add country')]
); ?>

</div>

<?= $this->element('Admin/View/buttons'); ?>

</div>
