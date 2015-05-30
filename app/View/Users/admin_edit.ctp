<h1>
	<?php
		echo $this->request->data['User']['lastname'];
		echo ' ';
		echo $this->request->data['User']['firstname'];
	?>
</h1>

<div class="user form">
	<?php
		echo $this->Bs3Form->create('User', array('formStyle' => 'horizontal'));
	?>
	<fieldset class="col-md-4 col-sm-6 col-xs-12">
		<legend><?php echo __('Identity'); ?></legend>
		<?php
			echo $this->Bs3Form->input('lastname');
			echo $this->Bs3Form->input('firstname');
			echo $this->Bs3Form->input('email');
			echo $this->Bs3Form->input('group_id');
		?>
		
		<?php
			echo $this->Bs3Form->input('id', array('type' => 'hidden'));
			echo $this->Bs3Form->submit(__('Save user'), array('class' => 'btn btn-info col-sm-offset-3'));	
			echo $this->Bs3Form->end(array('type' => 'hidden'));
		?>
	</fieldset>
	
	
	<fieldset class="col-md-4 col-sm-6 col-xs-12">
		<legend>
			<?php echo __('Courses'); ?>
			<button class="btn btn-sm btn-primary pull-right" onclick="hide_show('add_course');">
				<?php echo __('Add'); ?>
			</button>
		</legend>
		<div class="btn-group" id="add_course" style="display:none">
			<?php
				echo $this->Bs3Form->create('CoursesUser', array('action' => 'add', 'formStyle' => 'inline', 'class' => 'form-inline ajax_course'));
					echo $this->Bs3Form->input('instrument_id', array('empty' => __(' -- Instrument -- '), 'disabled' => array(''), 'selected' => array('')));
					echo $this->Bs3Form->input('cycle', array('type' => 'select', 'empty' => __(' -- Cycle -- '), 'disabled' => array('')));
					echo $this->Bs3Form->input('year', array('type' => 'select', 'empty' => __(' -- Year -- '), 'disabled' => array('')));
					echo $this->Bs3Form->input('user_id', array('value' => $this->request->data['User']['id'], 'type' => 'hidden'));
					echo $this->Bs3Form->submit(__('Add'), array('class' => 'btn btn-success', 'div' => 'form-group pull-right'));
				echo $this->Bs3Form->end(array('type' => 'hidden'));
			?>
		</div>
		<table class="table table-striped">
			<tr>
				<th><?php echo __('Instrument'); ?></th>
				<th><?php echo __('Cycle'); ?></th>
				<th><?php echo __('Year'); ?></th>
				<th class="actions actions-right"><?php echo __('Actions'); ?></th>
			</tr>
			<?php foreach ($courses as $k => $v) : ?>
				<tr>
					<td><?php echo $v['Course']['Instrument']['name']; ?></td>
					<td><?php echo $v['Course']['cycle']; ?></td>
					<td><?php echo $v['Course']['year']; ?></td>
					<td>
						<button class="btn btn-xs btn-danger pull-right">
							<?php
								echo $this->Html->link(
									__('Delete'),
									array('controller' => 'courses_users', 'action' =>'delete', $v['CoursesUser']['id'], $this->request->data['User']['id']),
									array('class' => 'action')
								);
							?>
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</fieldset>
	
	<fieldset class="col-md-4 col-sm-6 col-xs-12">
		<legend><?php echo __('Informations'); ?></legend>
		<?php echo $this->request->data['User']['last_connection']; ?>
		<br />
		<?php echo $this->request->data['User']['created']; ?>
	</fieldset>
	
	<fieldset class="col-md-4 col-sm-6 col-xs-12" style="clear:both;">
	</fieldset>
	
	<?php
		$this->Js->get('#CoursesUserInstrumentId')->event('change',
			$this->Js->request(
				array(
					'controller' => 'courses_users',
					'action' => 'ajaxGetCycles',
					'admin' => true
				),
				array(
					'update' => '#CoursesUserCycle',
					'async' => true,
					'method' => 'post',
					'dataExpression' => true,
					'data' => $this->Js->serializeForm(array('isForm' => true, 'inline' => true))
				)
			)	
		);
	?>
	
	<?php
		$this->Js->get('#CoursesUserCycle')->event('change',
			$this->Js->request(
				array(
					'controller' => 'courses_users',
					'action' => 'ajaxGetYears',
					'admin' => true
				),
				array(
					'update' => '#CoursesUserYear',
					'async' => true,
					'method' => 'post',
					'dataExpression' => true,
					'data' => '$(\'#CoursesUserCycle, #CoursesUserInstrumentId\').serializeArray()'
				)
			)
		);
	?>
	
</div>