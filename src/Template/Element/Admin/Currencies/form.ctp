<div class="ui top attached tabular menu">
<a class="active item" data-tab="currency"><?= __('Currency'); ?></a>
</div>

<!-- [ CURRENCY ]-->

<div class="ui bottom attached active tab segment" data-tab="currency">

<div class="ui three column stackable grid">
<div class="six wide column">

<h2><?= __('Details') ?></h2>

<?= $this->Form->input('name', [
    'templateVars' => ['format' => ' ten wide field'],
    'required' => true
]); ?>

<?= $this->Form->input('code', [
    'templateVars' => ['format' => ' six wide field'],
    'required' => true
]); ?>

<?= $this->Form->input('symbol', [
    'templateVars' => ['format' => ' six wide field'],
    'required' => true
]); ?>

</div>
<div class="five wide column">

<h2><?= __('Decimal Format') ?></h2>

<?= $this->Form->input('decimal_point', [
    'templateVars' => ['format' => ' six wide field'],
    'label' => __('Point'),
    'required' => true
]); ?>

<?= $this->Form->input('decimal_places', [
    'templateVars' => ['format' => ' six wide field'],
    'label' => __('Places'),
    'required' => true
]); ?>

<h2><?= __('Thousands Format') ?></h2>

<?= $this->Form->input('thousands_point', [
    'templateVars' => ['format' => ' six wide field'],
    'label' => __('Separator'),
    'required' => true
]); ?>

</div>
<div class="five wide column">

<h2><?= __('Symbols') ?></h2>

<?= $this->Form->input('symbol_name', [
    'templateVars' => ['format' => ' eight wide field'],
    'label' => __('Name')
]); ?>

<?= $this->Form->input('symbol_decimal', [
    'templateVars' => ['format' => ' eight wide field'],
    'label' => __('Decimal'),
    'required' => true
]); ?>

<?= $this->Form->input('symbol_hex', [
    'templateVars' => ['format' => ' eight wide field'],
    'label' => __('Hex'),
    'required' => true
]); ?>

</div>
</div>

</div>
