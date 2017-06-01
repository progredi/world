<?php

use Cake\Core\Configure;

/**
 * Region Admin List Template
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
        [__('Regions'), __('Regions Dashboard'), ['action' => 'index']]
    ]
]); ?>

<h1 class="ui large header"><?= __('Regions'); ?></h1>

<div class="ui stackable grid">
<div class="mobile only four wide column">

<!--[ ACTIONS + SEARCH FILTER ]-->

<div class="ui grid">
<div class="sixteen wide column">

<?= $this->Html->link('<i class="plus icon"></i>' . ' ' . __('Region'),
    ['action' => 'add'],
    ['class' => 'ui add button', 'title' => __('Add new region'), 'escape' => false]
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

<!--[ REGIONS LIST ]-->

<div class="ui grid">

<div class="sixteen wide column">

<table class="ui striped table">

<thead>

<tr>
<th><?= __('Name'); ?></th>
<th><?= __('Continent');?></th>
<th class="center aligned"><?= __('Countries');?></th>
<th class="center aligned status"><?= __('Status');?></th>
<th class="three action icons"><?= __('Actions');?></th>
</tr>

</thead>

<tbody>

<?php if (empty($regions)) : ?>
<tr>
<td colspan="5"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($regions as $region): ?>
<tr>
<td><?= h($region->name); ?></td>
<td><?= h($region->continent->name); ?></td>
<td class="center aligned"><?= count($region->countries); ?></td>
<td class="center aligned status"><?=

$region->enabled ?
    $this->Html->link('<i class="large enabled icon"></i>',
        ['action' => 'disable', $region->id],
        ['title' => __('Region is enabled: click to disable'), 'escape' => false]) :
    $this->Html->link('<i class="large disabled icon"></i>',
        ['action' => 'enable', $region->id],
        ['title' => __('Region is disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

$this->Html->link('<i class="large view record icon"></i>',
    ['action' => 'view', $region->id],
    ['title' => __('View region'), 'escape' => false]
);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
    ['action' => 'edit', $region->id],
    ['title' => __('Edit region'), 'escape' => false]
);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
    ['action' => 'delete', $region->id],
    ['title' => __('Delete region'), 'confirm' => __('Are you sure?'), 'escape' => false]
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

<?= $this->Html->link('<i class="plus icon"></i>' . ' ' . __('Region'),
    ['action' => 'add'],
    ['class' => 'ui add button', 'title' => __('Add new region'), 'escape' => false]
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
