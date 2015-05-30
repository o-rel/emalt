<h1>
	<?php
		echo 'Edit instrument : ';
		echo $this->request->data['Instrument']['name'];
		echo ' ';
	?>
</h1>

<div class="instrument form">
	<?php
		echo $this->Bs3Form->create('Instrument', array('formStyle' => 'horizontal'));
	?>
	<fieldset class="col-md-4 col-sm-6 col-xs-12">
		<legend><?php echo __('Instrument'); ?></legend>
		<?php
			echo $this->Bs3Form->input('name');
			echo $this->Bs3Form->input('id', array('type' => 'hidden'));
			echo $this->Bs3Form->submit(__('Save instrument'), array('class' => 'btn btn-info col-sm-offset-3'));
			echo $this->Bs3Form->end(array('type' => 'hidden'));
		?>
	</fieldset>
	<fieldset class="col-md-4 col-sm-6 col-xs-12">
		<legend>
			<?php 
				echo (__('Courses'));
			?>
			<?php
				echo $this->Html->link(
					__('Add'),
					array('controller' => 'courses', 'action' => 'add', $this->request->data['Instrument']['id']),
					array('class' => 'btn btn-sm btn-primary pull-right')	
				); 
			?>
		</legend>
		<?php if (!empty($courses)) { ?>
			<table class="table table-striped">
				<tr>
					<th><?php echo $this->Paginator->sort('cycle', __('Cycle')); ?></th>
					<th><?php echo $this->Paginator->sort('year', __('Year')); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				<?php foreach ($courses as $v => $k) : ?>
					<tr>
						<td><?php echo $k['Course']['cycle']; ?></td>
						<td><?php echo $k['Course']['year']; ?></td>
						<td>
							<div class="btn-group">
								<?php 
									echo $this->Html->link(
										__('Edit'),
										array('controller' => 'courses', 'action' => 'edit', $k['Course']['id']),
										array('class' => 'action btn btn-xs btn-info')
									);
								?>
								<?php
									echo $this->Html->link(
										__('Delete'),
										array('controller' => 'courses', 'action' => 'delete', $k['Course']['id']),
										array('class' => 'action btn btn-xs btn-danger'),
										__('Are you sure you wish to delete this course ?')
									);
								?>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php } else {
			echo __('No class have been created for this instrument yet');
		} ?>
	</fieldset>
	<filedset class="col-md-4 col-sm-6 col-xs-12">
		<legend>
			<?php echo __('Students'); ?>
		</legend>
		<?php if (!empty($students)) { ?>
			<table class="table table-striped">
				<tr>
					<th><?php echo $this->Paginator->sort('firstname', __('Firstname')); ?></th>
					<th><?php echo $this->Paginator->sort('lastname', __('Lastname')); ?></th>
					
				</tr>
				<?php foreach ($students as $v => $k) : ?>
					<tr>
						<td><?php echo $k['User']['firstname']; ?></td>
						<td><?php echo $k['User']['lastname']; ?></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php } else {
			echo __('No students are attempting any class for this instrument');
		} ?>
	</filedset>
</div>
