<h1>
	<?php
		echo __('Edit course : ');
		echo $this->request->data['Instrument']['name'];
		echo ' ';
		echo $this->request->data['Course']['cycle'];
		echo __(' cycle ');
		echo $this->request->data['Course']['year'];
		echo __(' year ');
	?>
</h1>

<div class="course form">
	<?php
		echo $this->Bs3Form->create('Course', array('formStyle' => 'horizontal'));
	?>
	<fieldset class="col-md-4 col-sm-6 col-xs-12">
		<legend><?php echo __('Course'); ?></legend>
		<?php
			echo $this->Bs3Form->input('instrument_id');
			echo $this->Bs3Form->input('cycle');
			echo $this->Bs3Form->input('year');
		?>
		
		<?php
			echo $this->Bs3Form->input('id', array('type' => 'hidden'));
			echo $this->Bs3Form->submit(__('Save course'), array('class' => 'btn btn-info col-sm-offset-3'));
			echo $this->Bs3Form->end(array('type' => 'hidden'));
		?>
	</fieldset>
	
	<fieldset class="col-md-4 col-sm-6 col-xs-12">
		<legend>
			<?php echo __('Students'); ?>
			
			<?php 
				echo $this->Html->link(
					__('Add'), 
					array('controller' => 'courses_users', 'action' => 'addfromcourse', $this->request->data['Course']['id']),
					array('class' => 'btn btn-sm btn-primary pull-right')						
				); 
			?>
		</legend>
		<?php
		if (!empty($students)) { ?>
			<table class="table table-striped">
				<tr>
					<th><?php echo $this->Paginator->sort('firstname', __('Firstname')); ?></th>
					<th><?php echo $this->Paginator->sort('lastname', __('Lastname')); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				<?php foreach ($students as $v => $k) : ?>
					<tr>
						<td><?php echo $k['User']['firstname']; ?></td>
						<td><?php echo $k['User']['lastname']; ?></td>
						<td>
							<div class="btn-group">
								<?php 
									echo $this->Html->link(
										__('Edit'),
										array('controller' => 'users', 'action' => 'edit', $k['User']['id']),
										array('class' => 'action btn btn-xs btn-info')
									);
								?>
								<?php
									echo $this->Html->link(
										__('Delete'),
										array('controller' => 'courses_users', 'action' => 'deletefromcourse', $k['CoursesUser']['id'], $this->request->data['Course']['id']),
										array('class' => 'action btn btn-xs btn-danger'),
										__('Are you sure you wish to delete this users from the course ?')
									);
								?>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php } else {
			echo __('No students are attempting this class');
		} ?>
	</fieldset>
	
	<?php $i=0;?>
	
	<filedset class="col-md-4 col-sm-6 col-xs-12">
		<legend>
			<?php echo __('Score'); ?>
			<?php 
				echo $this->Html->link(
					__('Add'),
					array('controller' => 'scores', 'action' => 'add'),
					array('class' => 'btn btn-sm btn-primary pull-right')
				); ?>
		</legend>
		<?php if (!empty($scores)) { ?>
			<table class="table table-striped">
				<tr>
					<th><?php echo $this->Paginator->sort('name', __('Name')); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				<?php foreach ($scores as $v => $k) : ?>
					<?php $i++;?>
					<tr>
						<td><?php echo $k['Score']['name']; ?></td>
						<td>
							<div class="btn-group">
								<?php 
									/*echo $this->Html->link(
										__('Edit'),
										array('controller' => 'scores', 'action' => 'edit', $k['Score']['id']),
										array('class' => 'action btn btn-xs btn-info')
									);*/
								?>
								<?php
									echo $this->Html->link(
										__('Delete'),
										array('controller' => 'scores', 'action' => 'deleteFromCourses', $k['Score']['id'], $this->request->data['Course']['id']),
										array('class' => 'action btn btn-xs btn-danger'),
										__('Are you sure you wish to delete this score ?')
									);
								?>
							</div>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php } else {
			echo __('No scores are linked to this class');
		} ?>
		<?php echo $i;?>
	</filedset>
</div>
