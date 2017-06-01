<div class="buttons">

<?= $this->Html->link(__('Cancel'),
    env('HTTP_REFERER'),
    ['class' => 'ui cancel button', 'title' => __('Exit edit mode')]
); ?>

<?= $this->Form->button(__('Apply'),
    ['name' => 'apply', 'class' => 'ui apply button', 'title' => __('Apply changes and stay in edit mode')]
); ?>

<?= $this->Form->button(__('Done'),
    ['class' => 'ui done button', 'title' => __('Save changes and exit edit mode')]
); ?>

</div>