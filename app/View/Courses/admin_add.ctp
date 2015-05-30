<div class="courses form">
	<?php
		echo $this->Bs3Form->create('Course', array('formStyle' => 'horizontal'));
	?>
	<fieldset class="col-md-4 col-sm-4 col-xs-12">
		<legend><?php echo (__('Add course')); ?></legend>
		<?php
			echo $this->Bs3Form->input('instrument_id');
			echo $this->Bs3Form->input('cycle');
			echo $this->Bs3Form->input('year');
		?>
		
		<?php
			echo $this->Bs3Form->submit(__('Add course'), array('class' => 'btn btn-success col-sm-offset-3'));
			echo $this->Bs3Form->end(array('type' => 'hidden'));
		?>
	</fieldset>
</div>
