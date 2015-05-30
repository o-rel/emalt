<div class="audios form">
	<?php
		echo $this->Bs3Form->create('Audio', array('formStyle' => 'horizontal', 'type' => 'file'));
	?>
	<fieldset class="col-md-4 col-sm-4 col-xs-12">
		<legend><?php echo (__('Add audio file')); ?></legend>
		<?php
			echo $this->Bs3Form->input('upload', array('type' => 'file'));
			echo $this->Bs3Form->input('name', array('label' => __('Name')));
			/*echo $this->Bs3Form->input('instrument_id', array('empty' => __(' -- Instrument -- '), 'disabled' => array(''), 'selected' => array('')));
			echo $this->Bs3Form->input('cycle', array('type' => 'select', 'empty' => __(' -- Cycle -- '), 'disabled' => array('')));
			echo $this->Bs3Form->input('year', array('type' => 'select', 'empty' => __(' -- Year -- '), 'disabled' => array('')));*/
			echo $this->Bs3Form->submit(__('Add audio file'), array('class' => 'btn btn-success col-sm-offset-3'));
		?>
	</fieldset>
	<?php
		echo $this->Bs3Form->end(array('type' => 'hidden'));
	?>
</div>

<?php
	/*$this->Js->get('#AudioInstrumentId')->event('change',
		$this->Js->request(
			array(
				'controller' => 'courses_users',
				'action' => 'ajaxGetCycles',
				'admin' => true
			),
			array(
				'update' => '#AudioCycle',
				'async' => true,
				'method' => 'post',
				'dataExpression' => true,
				'data' => $this->Js->serializeForm(array('isForm' => true, 'inline' => true))
			)
		)
	);
?>

<?php
	$this->Js->get('#AudioCycle')->event('change',
		$this->Js->request(
			array(
				'controller' => 'courses_users',
				'action' => 'ajaxGetYears',
				'admin' => true,
			),
			array(
				'update' => '#AudioYear',
				'async' => true,
				'method' => 'post',
				'dataExpression' => true,
				'data' => '$(\'#AudioCycle, #AudioInstrumentId\').serializeArray()'
			)
		)
	);*/
?>