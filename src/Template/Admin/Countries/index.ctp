<?php

/**
 * Country Admin List Template
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
        [__('Countries'), __('Countries Dashboard'), ['action' => 'index']]
    ]
]); ?>

<h1 class="ui large header"><?= __('Countries'); ?></h1>

<div class="ui stackable grid">
<div class="mobile only four wide column">

<!--[ ACTIONS + SEARCH FILTER ]-->

<div class="ui grid">
<div class="sixteen wide column">

<?= $this->Html->link('<i class="plus icon"></i>' . ' ' . __('Country'),
    ['action' => 'add'],
    ['class' => 'ui add button', 'title' => __('Add new country'), 'escape' => false]
); ?>

</div>
<div class="sixteen wide column">

<?= $this->element('search-filter', [
    'columns' => ['id', 'name'],
    'default' => 'name'
]); ?>

</div>
</div>

</div>
<div class="twelve wide column">

<!--[ COUNTRIES LIST ]-->

<div class="ui grid">

<div class="sixteen wide column">

<table class="ui striped table">

<thead>

<tr>
<th><?= $this->Paginator->sort('Countries.name', __('Name')); ?></th>
<th class="description"><?= $this->Paginator->sort('Regions.name', __('Region'));// __('Region'); ?></th>
<th class="description"><?= $this->Paginator->sort('Continents.name', __('Continent')); // __('Continent'); ?></th>
<th class="center aligned status"><?= $this->Paginator->sort('Countries.enabled', __('Status')); ?></th>
<th class="three action icons"><?= __('Actions');?></th>
</tr>

</thead>

<tbody>

<?php if (!$countries) : ?>
<tr>
<td colspan="5"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($countries as $country): ?>
<tr>
<td><i class="<?= strtolower(h($country->alpha_2_code)); ?> flag" styles="margin:0"></i> <?= h($country->name); ?></td>
<td><?= h($country->region->name); ?></td>
<td><?= h($country->region->continent->name); ?></td>
<td class="center aligned status"><?=

$country->enabled ?
    $this->Html->link('<i class="large enabled icon"></i>',
        ['action' => 'disable', $country->id],
        ['title' => __('Country') . ' ' . __('is enabled: click to disable'), 'escape' => false]) :
    $this->Html->link('<i class="large disabled icon"></i>',
        ['action' => 'enable', $country->id],
        ['title' => __('Country') . ' ' . __('is disabled: click to enable'), 'escape' => false]);

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

<?= $this->Html->link('<i class="plus icon"></i>' . ' ' . __('Country'),
    ['action' => 'add'],
    ['class' => 'ui add button', 'title' => __('Add new country'), 'escape' => false]
); ?>

</div>
<div class="sixteen wide column">

<?= $this->element('search-filter', [
    'columns' => ['id', 'name'],
    'default' => 'name'
]); ?>

</div>
</div>

</div>
</div>
