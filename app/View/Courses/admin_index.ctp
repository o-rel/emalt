<div class=" col-md-9 col-xs-12">
	<table class="table table-striped">
		<tr>
			<th><?php echo $this->Paginator->sort('instrument_id', __('Instrument')); ?></th>
			<th><?php echo $this->Paginator->sort('cycle', __('Cycle')); ?></th>
			<th><?php echo $this->Paginator->sort('year', __('Year')); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		
		<?php foreach ($data as $u => $k): ?>
			<?php $v = current($k); ?>
			<tr>
				<td>
					<?php echo $k['Instrument']['name']; ?>
				</td>
				<td>
					<?php echo $v['cycle']; ?>
				</td>
				<td>
					<?php echo $v['year']; ?>
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
								__('Are you sure you wish to delete the course ') . $k['Instrument']['name'] . __(' Cycle : ') . $v['cycle'] . __(' Year : ') . $v['year'] . ' ?'
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
				__('Add course'),
				array('action' => 'add'),
				array('class' => 'btn btn-success')
			); ?>
		</li>
		<li class="pull-right">
			<ul class="head-list">
				<li>
					<?php
						echo $this->Form->create('Course', array(
							'url' => array_merge(array('controller' => "courses", 'action' => 'admin_index'), $this->params['pass']),
							'class' => 'form-inline'
						));
							echo $this->Form->input('filter', array(
								'type' => 'text',
								'after' => false,
								'label' => array('class' => 'sr-only'),
								'class' => array('class' => 'form-control form-search'),
								'placeholder' => __('Search')
							));
							echo $this->Form->button(__('Search'), array('class' => 'btn btn-hidden'));
						echo $this->Form->end();
					?>
				</li>
				<li>
					<?php
						echo $this->Form->create('Course', array(
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
