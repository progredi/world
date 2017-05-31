<div class="ui top attached tabular menu">
<a class="active item" data-tab="region"><?= __('Region'); ?></a>
</div>

<!--[ REGION ]-->

<div class="ui bottom attached active tab segment" data-tab="region">

<div class="ui two column stackable grid">
<div class="column">

<h2><?= __('Details'); ?></h2>

<?= $this->Form->input('name', [
	'templateVars' => ['format' => ' twelve wide field'],
	'required' => true
]); ?>

<?= $this->Form->input('region_id', [
	'templateVars' => [
		'format' => ' ten wide field'
	],
	'label' => __('Region'),
	'class' => 'ui dropdown',
	'options' => $continentsOptions,
	'required' => true,
	'empty' => true
]); ?>

</div>
<div class="column">

<h2><?//= ; ?></h2>

</div>
</div>

</div>
