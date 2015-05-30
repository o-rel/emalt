<div class="users form">
	<?php 
		echo $this->Bs3Form->create('User', array('formStyle' => 'horizontal'));
	?>
	<fieldset class="col-md-4 col-sm-4 col-xs-12">
		<legend><?php echo (__('Add user')); ?></legend>
		<?php
			echo $this->Bs3Form->input('firstname');
			echo $this->Bs3Form->input('lastname');
			echo $this->Bs3Form->input('email');
			//echo $this->Bs3Form->input('password');
			echo $this->Bs3Form->input('group_id');
		?>
		
		<?php
			echo $this->Bs3Form->submit(__('Add user'), array('class' => 'btn btn-success col-sm-offset-3'));
		?>
	</fieldset>
	<?php
		echo $this->Bs3Form->end(array('type' => 'hidden'));
	?>
</div>

<!--<?php echo $this->Form->create('User'); ?>

<fieldset class="col-md-4 col-sm-4 col-xs-12">
	<legend><?php echo (__('Add user')); ?></legend>
	<?php
		echo $this->Form->input('firstname');
		echo $this->Form->input('lastname');
		echo $this->Form->input('email');
		echo $this->Form->input('group_id');
		echo $this->Form->submit(__('Add user'), array('class' => 'btn btn-success col-sm-offset-3'));
	?>
</fieldset>

<?php echo $this->Form->end(); ?>-->

