<?php

use Cake\Network\Session;
$session = $this->request->session();

?>
<div class="buttons">

<?= $this->Html->link(__('Cancel'),//'<i class="remove icon"></i> ' .
	$session->read('App.referrer'),
	['class' => 'ui cancel button', 'title' => __('Exit edit mode'), 'escape' => false]
); ?>

<?= $this->Form->button(__('Apply'),//'<i class="checkmark icon"></i> ' .
	['name' => 'apply', 'class' => 'ui apply button', 'title' => __('Apply changes and stay in edit mode')]
); ?>

<?= $this->Form->button(__('Done'),//'<i class="save icon"></i> ' .
	['class' => 'ui done button', 'title' => __('Save changes and exit edit mode')]
); ?>

</div>