<div class="ui top attached tabular menu">
<a class="active item" data-tab="country"><?= __('Country'); ?></a>
</div>

<!--[ COUNTRY ]-->

<div class="ui bottom attached active tab segment" data-tab="country">

<div class="ui three column stackable grid">
<div class="eight wide column">

<h2><?= __('Details'); ?></h2>

<?= $this->Form->input('name', [
    'templateVars' => [
        'format' => ' ten wide field'
    ]
]); ?>

<?= $this->Form->input('region_id', [
    'templateVars' => [
        'format' => ' ten wide field'
    ],
    'label' => __('Region'),
    'class' => 'ui dropdown',
    'options' => $regionsOptions,
    'empty' => true
]); ?>

<?= $this->Form->input('official_name', [
    'templateVars' => [
        'format' => ' fourteen wide field'
    ]
]); ?>

<?= $this->Form->input('demonym', [
    'templateVars' => [
        'format' => ' ten wide field'
    ]
]); ?>

</div>
<div class="four wide column">

<h2><?= __('Codes'); ?></h2>

<?= $this->Form->input('alpha_3_code', [
    'templateVars' => [
        'format' => ' fourteen wide field'
    ],
    'label' => __('Alpha 3')
]); ?>

<?= $this->Form->input('alpha_2_code', [
    'templateVars' => [
        'format' => ' fourteen wide field'
    ],
    'label' => __('Alpha 2')
]); ?>

<?= $this->Form->input('numeric_code', [
    'templateVars' => [
        'format' => ' fourteen wide field'
    ],
    'label' => __('Numeric')
]); ?>

</div>
<div class="four wide column">

<h2><?= __('Location'); ?></h2>

<?= $this->Form->input('calling_code', [
    'templateVars' => [
        'format' => ' fourteen wide field'
    ]
]); ?>

<?= $this->Form->input('latitude', [
    'templateVars' => [
        'format' => ' fourteen wide field'
    ]
]); ?>

<?= $this->Form->input('longitude', [
    'templateVars' => [
        'format' => ' fourteen wide field'
    ]
]); ?>

</div>
</div>

</div>
