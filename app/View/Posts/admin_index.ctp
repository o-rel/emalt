<div class="col-md-9">
	<table class="table table-striped table-hover table-condensed">
		<tr>
			<th><?php echo $this->Paginator->sort('title', __('Title')); ?></th>
			<th><?php echo $this->Paginator->sort('created', __('Created')); ?></th>
			<th><?php echo $this->Paginator->sort('modified', __('Modified')); ?></th>
			<th><?php echo $this->Paginator->sort('user_id', __('Author')); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		
		<?php foreach ($data as $u => $k): ?>
			<?php $v = current($k); ?>
			
			<tr>
				<td>
					<?php echo $v['title']; ?>
				</td>
				<td>
					<?php echo $v['created']; ?>
				</td>
				<td>
					<?php echo $v['modified']; ?>
				</td>
				<td>
					<?php echo $this->Html->link(
						$k['User']['lastname'] . ' ' . $k['User']['firstname'],
						array('controller' => 'users', 'action' => 'view', $v['user_id'], 'admin' => true)	
					); ?> 
				</td>
				<td>
					<div class="btn-group">
						<?php
							echo $this->Html->link(
								__('Edit'),
								array('action' => 'edit', $v['id']),
								array('class' => 'action btn btn-xs btn-info')
							);
						?>
						<?php
							echo $this->Html->link(
								__('Delete'),
								array('action' => 'delete', $v['id']),
								array('class' => 'action btn btn-xs btn-danger'),
								__('Are you sure you wish to delete the post : ') . $v['title'] . ' ?'
							);
						?>
					</div>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<div class="col-md-3">
	<ul class="head-list">
		<li>	
			<?php echo $this->Html->link(
				__('Add post'),
				array('action' => 'add'),
				array('class' => 'btn btn-success')
			); ?>
		</li>
		<li class="pull-right">
			<?php
				echo $this->Form->create('Post', array(
					'url' => array_merge(array('action' => 'admin_index')),
					'class' => 'form-inline'
				));
					echo $this->Form->button(__('Clear filter'), array('class' => 'btn btn-primary'));
				echo $this->Form->end();
			?>
		</li>
		<li class="pull-right">
			<?php 
				echo $this->Form->create('Post', array(
					'url' => array_merge(array('controller' => 'posts', 'action' => 'admin_index'), $this->params['pass']),
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
	</ul>
	
	<?php echo $this->Element('paginate'); ?>
	
</div>
