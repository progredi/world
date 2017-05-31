<?php

use Cake\Network\Session;
use Cake\Utility\Inflector;

?>
<div class="buttons">

<?= $this->Form->postLink(__('Delete'),
	['action' => 'delete', $this->request->params['pass'][0]],
	[
		'class' => 'ui delete button',
		'title' => __('Delete ' . strtolower(Inflector::singularize(Inflector::humanize($this->request->params['controller'])))),
		'confirm' => __('Are you sure?'),
		'escape' => false
	]
); ?>

<?= $this->Html->link(__('Edit'),
	['action' => 'edit', $this->request->params['pass'][0]],
	['class' => 'ui edit button', 'title' => 'Edit ' .
		strtolower(Inflector::singularize(Inflector::humanize($this->request->params['controller'])))]
); ?>

<?= $this->Html->link(__('Done'),
	['action' => 'index'],
	['class' => 'ui done button', 'title' => __('Return')]
); ?>

</div>
