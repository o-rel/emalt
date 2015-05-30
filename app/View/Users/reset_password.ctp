<?php $this->Html->addCrumb(__('Forgot password'), array('controller' => 'users', 'action' => 'reset_password')); ?>

<div class='col-md-4 col-sm-5'>
	<?php
		echo $this->Form->create('User');
			echo $this->Form->input('email', array('placeholder' => __('Email'), 'class' => 'form-control', 'div' => 'col-sm-12 loginform', 'label' => array('class' => 'sr-only')));
			echo $this->html->link(
				__('Nevermind'),
				array('action' => 'login'),
				array(
					'class' => 'btn btn-sm btn-danger pull-right forgot loginform',
					'id' => 'forgot'
				)
			);
			echo $this->Form->submit(__('Reset'), array('class' => 'btn btn-sm btn-primary loginform', 'confirm' => __('Are you sure you want to reset your password ?')));
		echo $this->Form->end();
		echo $this->Session->flash();
	?>
</div>