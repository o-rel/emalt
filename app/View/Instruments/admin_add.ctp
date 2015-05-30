<div class="instruments form">
	<?php
		echo $this->Bs3Form->create('Instrument', array('formStyle' => 'horizontal'));
	?>
	<fieldset>
		<legend><?php echo __('Add instrument'); ?></legend>
		<?php
			echo $this->Bs3Form->input('name');
		?>
	</fieldset>
	<?php
		echo $this->Bs3Form->submit(__('Add instrument'), array('class' => 'btn btn-info col-sm-offset-3'));
		echo $this->Bs3Form->end();
	?>
</div>
