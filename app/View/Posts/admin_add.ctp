<div class="posts form">
	<?php
		echo $this->Bs3Form->create(__('Post'), array('formStyle' => 'horizontal'));
	?>
	<fieldset class="col-md-4 col-sm-6 col-xs-12">
		<legend><?php echo __('Add post'); ?></legend>
		<?php
			echo $this->Bs3Form->input(__('title'));
			echo $this->Bs3Form->input(__('content'));
			echo $this->Bs3Form->submit(__('Add post'), array('class' => 'btn btn-success col-sm-offset-3'));
		?>
	</fieldset>
	<?php echo $this->Bs3Form->end; ?>
</div>
