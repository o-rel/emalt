<?php $this->Html->addCrumb(__('Edit profile'), array('controller' => 'users', 'action' => 'edit')); ?>

<div class="user form">
	<fieldset class="col-ms-4 col-sm-6 col-xs-12">
		<?php 
			echo $this->Form->create('User', array('formStyle' => 'min')); 
		?>	
		<legend><?php echo __('Informations'); ?></legend>
		<?php
				echo $this->Form->input('email', array('class' => 'form-control', 'div' => 'col-sm-12 loginform', 'label' => array('class' => 'sr-only')));
				echo $this->Form->input('id', array('type' => 'hidden'));
				echo $this->Form->submit(__('Save email'), array('class' => 'btn btn-primary'), array('class' => 'btn btn-sm btn-primary loginform'));
			echo $this->Form->end(array('type' => 'hidden'));
		?>
	</fieldset>
	
	<fieldset class="col-ms-4 col-sm-6 col-xs-12">
		<?php echo $this->Bs3Form->create('User', array('action' => 'change_password', 'formStyle' => 'min')); ?>
		<legend><?php echo __('Password'); ?></legend>
		<?php
				echo $this->Form->input('password', array('placeholder' => __('Password'), 'class' => 'form-control', 'div' => 'col-sm-12 loginform', 'label' => array('class' => 'sr-only')));
				echo $this->Form->input('checkpwd', array('placeholder' => __('Verify'), 'type' => 'password', 'class' => 'form-control', 'div' => 'col-sm-12 loginform', 'label' => array('class' => 'sr-only')));
				echo $this->Form->input('id', array('type' => 'hidden'));
				echo $this->Form->submit(__('Change password'), array('class' => 'btn btn-primary'), array('class' => 'btn btn-sm btn-primary loginform'));
			echo $this->Form->end(array('type' => 'hidden'));
		?>
	</fieldset>
</div>
