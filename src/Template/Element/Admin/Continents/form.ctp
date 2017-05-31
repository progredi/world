<div class="ui top attached tabular menu">
<a class="active item" data-tab="continent"><?= __('Continent'); ?></a>
</div>

<!--[ CONTINENT ]-->

<div class="ui bottom attached active tab segment" data-tab="continent">

<div class="ui two column stackable grid">
<div class="column">

<h2><?= __('Details'); ?></h2>

<?= $this->Form->input('name', [
	'templateVars' => ['format' => ' twelve wide field'],
	'required' => true
]); ?>

</div>
<div class="column">

<?//=  ?>

</div>
</div>

</div>
