<div class="col-md-9 col-sm-12 col-xs-12">
	<table class="table table-striped">
		<tr>
			<th><?php echo __('Firstname'); ?></th>
			<th><?php echo __('Lastname'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
		
		<?php foreach ($data as $v => $k) : ?>
			<tr>
				<td><?php echo $k['firstname']; ?></td>
				<td><?php echo $k['lastname']; ?></td>
				<td>
					<?php 
						echo $this->Html->link(
							'Add',
							array('controller' => 'courses_users', 'action' => 'addfromcourseuser', $k['id'], $this->request->pass['0'], 'admin' => true),
							array('class' => 'btn btn-sm btn-success pull-right')	
						);
					?>
				</td>
			</tr>
		<?php endforeach; ?>
	</table>
</div>
<div class="col-md-3 col-sm-6 col-xs-6">
	<ul class="head-list">
		<li>
			<?php echo $this->Html->link(
				__('Return to course'),
				array('controller' => 'courses', 'action' => 'edit', $this->request->pass['0']),
				array('class' => 'btn btn-primary')
			); ?>
		</li>
	</ul>
</div>
