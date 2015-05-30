<!--<ul class="head-list">
	<li><h1><?php echo __('Users list'); ?></h1></li>
	<li><button class="btn btn-success">
		<?php
			echo $this->Html->link(
				__('Add'),
				array('action' => 'add')
			);
		?>
	</button></li>
</ul>-->
<div class="col-md-9 col-xs-12">
	<table class="table table-striped">
		<tr>
			<th><?php echo $this->Paginator->sort('lastname', __('Lastname')); ?></th>
			<th><?php echo $this->Paginator->sort('firstname', __('Firstname')); ?></th>
			<th><?php echo $this->Paginator->sort('email', __('Email')); ?></th>
			<th><?php echo $this->Paginator->sort('group_id', __('Group')); ?></th>
			<th class="col-sm-*"><?php echo $this->Paginator->sort('created', __('Created')); ?></th>
			<th class="col-sm-*"><?php echo $this->Paginator->sort('last_connection', __('Last connection')); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		
		<?php
			$count = 0;
			$count_admin = 0;
			$count_students = 0; 
		?>
		
		<?php foreach ($data as $u => $k): ?>
			<?php 
				$v = current($k);
				/*$count++;
				if ($k['Group']['name'] == 'administrator')
					$count_admin++;
				if ($k['Group']['name'] == 'students')
					$count_students++;*/
			?>
			<tr>
				<td>
					<?php echo $v['lastname']; ?>
				</td>
				<td>
					<?php echo $v['firstname']; ?>
				</td>
				<td>
					<?php echo $v['email']; ?>
				</td>
				<td>
					<?php echo $k['Group']['name']; ?>
				</td>
				<td class="col-sm-*">
					<?php echo $v['created']; ?>
				</td>
				<td class="col-sm-*">
					<?php echo $v['last_connection']; ?>
				</td>
				<td>
					<div class="btn-group">
						<?php
							echo $this->Html->link(
								__('Edit'),
								array('action' =>'edit', $v['id']),
								array('class' => 'action btn btn-xs btn-info')
							);
						?>
						<?php
							echo $this->Html->link(
								__('Delete'),
								array('action' =>'delete', $v['id']),
								array('class' => 'action btn btn-xs btn-danger'),
								__('Are you sure you wish to delete the user : ') . $v['firstname'] . ' ' . $v['lastname'] . ' ?'
							);
						?>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<div class="col-md-3 col-xs-12">
	<ul class="head-list">
		<li>
			<?php echo $this->Html->link(
				__('Add user'),
				array('action' => 'add'),
				array('class' => 'btn btn-success')
			); ?>
		</li>
		<li class="pull-right">
			<ul class="head-list">
				<li>
					<?php 
						echo $this->Form->create('User', array(
							'url' => array_merge(array('controller' => 'users', 'action' => 'admin_index'), $this->params['pass']),
							'class' => 'form-inline'
						));
							echo $this->Form->input('filter', array(
								'type' => 'text',
								'after' => false,
								'label' => array('class'=>'sr-only'),
								'class' => array('class'=>'form-control form-search'),
								'placeholder' => __('Search')
							));
							echo $this->Form->button(__('Search'), array('class' => 'btn btn-hidden'));
						echo $this->Form->end();
					?>
				</li>
				<li>
					<?php
						echo $this->Form->create('User', array(
							'url' => array_merge(array('action' => 'admin_index')),
							'class' => 'form-inline'
						));
							echo $this->Form->button(__('Clear filter'), array('class' => 'btn btn-primary'));
						echo $this->Form->end();
					?>
				</li>
			</ul>
		</li>
	</ul>
	
	<?php echo $this->Element('paginate'); ?>
	
</div>
<!--<div class="col-md-3">
	<?php
		//echo __('Number of users : ') . $count . '<br />';
		echo __('Number of administrators : ') . $nbadmins . '<br />';
		echo __('Number of students : ') . $nbstudents . '<br />'; 
	?>
</div>-->