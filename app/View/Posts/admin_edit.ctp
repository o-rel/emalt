<h1>
	<?php
		echo 'Edit post : ';
		echo $this->request->data['Post']['title'];
		echo ' ';
	?>
</h1>

<div class="instrument form">
	<?php
		echo $this->Bs3Form->create('Post', array('formStyle' => 'horizontal'));
	?>
	<fieldset class="col-md-4 col-sm-6 col-xs-12">
		<?php
			echo $this->Bs3Form->input('title');
			echo $this->Bs3Form->input('content');
			echo $this->Bs3Form->input('id', array('type' => 'hidden'));
			echo $this->Bs3Form->submit(__('Save post'), array('class' => 'btn btn-info col-sm-offset-3'));
			echo $this->Bs3Form->end(array('type' => 'hidden'));
		?>
	</fieldset>
</div>