<?php

use Cake\Core\Configure;

/**
 * Continent Admin List Template
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
        [__('Continents'), __('Continents Dashboard'), ['action' => 'index']]
    ]
]); ?>

<h1 class="ui large header"><?= __('Continents'); ?></h1>

<div class="ui stackable grid">
<div class="mobile only four wide column">

<!--[ ACTIONS + SEARCH FILTER ]-->

<div class="ui grid">
<div class="sixteen wide column">

<?= $this->Html->link('<i class="plus icon"></i>' . ' ' . __('Continent'),
    ['action' => 'add'],
    ['class' => 'ui add button', 'title' => __('Add new continent'), 'escape' => false]
); ?>

</div>
<div class="sixteen wide column">

<?= $this->element('search-filter', [
    'columns' => ['name'],
    'default' => 'name'
]); ?>

</div>
</div>

</div>
<div class="twelve wide column">

<!--[ CONTINENTS LIST ]-->

<div class="ui grid">

<div class="sixteen wide column">

<table class="ui striped table">

<thead>

<tr>
<th><?= __('Name'); ?></th>
<th class="center aligned"><?= __('Regions');?></th>
<th class="center aligned"><?= __('Countries');?></th>
<th class="center aligned status"><?= __('Status');?></th>
<th class="three action icons"><?= __('Actions');?></th>
</tr>

</thead>

<tbody>

<?php if (empty($continents)) : ?>
<tr>
<td colspan="5"><?= __('No records found'); ?></td>
</tr>

<?php else: ?>
<?php foreach ($continents as $continent): ?>
<tr>
<td><?= h($continent->name); ?></td>
<td class="center aligned"><?= count($continent->regions); ?></td>
<td class="center aligned"><?= count($continent->countries); ?></td>
<td class="center aligned status"><?=

$continent->enabled ?
    $this->Html->link('<i class="large enabled icon"></i>',
        ['action' => 'disable', $continent->id],
        ['title' => __('Continent is enabled: click to disable'), 'escape' => false]) :
    $this->Html->link('<i class="large disabled icon"></i>',
        ['action' => 'enable', $continent->id],
        ['title' => __('Continent is disabled: click to enable'), 'escape' => false]);

?></td>
<td class="three action icons"><?=

$this->Html->link('<i class="large view record icon"></i>',
    ['action' => 'view', $continent->id],
    ['title' => __('View continent'), 'escape' => false]
);

?> <?=

$this->Html->link('<i class="large edit record icon"></i>',
    ['action' => 'edit', $continent->id],
    ['title' => __('Edit continent'), 'escape' => false]
);

?> <?=

$this->Form->postLink('<i class="large delete record icon"></i>',
    ['action' => 'delete', $continent->id],
    ['title' => __('Delete continent'), 'confirm' => __('Are you sure?'), 'escape' => false]
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

<?= $this->Html->link('<i class="plus icon"></i>' . ' ' . __('Continent'),
    ['action' => 'add'],
    ['class' => 'ui add button', 'title' => __('Add new continent'), 'escape' => false]
); ?>

</div>
<div class="sixteen wide column">

<?= $this->element('search-filter', [
    'columns' => ['name'],
    'default' => 'name'
]); ?>

</div>
</div>

</div>
</div>
