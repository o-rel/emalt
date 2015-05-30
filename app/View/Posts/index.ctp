<?php $this->Html->addCrumb(__('Posts'), array('controller' => 'posts', 'action' => 'index')); ?>

<header>
	<?php
		echo __('SHOWING NEWS ');
		echo $this->Paginator->counter('{:start} - {:end}');
		echo __(' OF ');
		echo $this->Paginator->counter('{:count}');
	
		echo $this->element('paginate');
	?>
</header>

<?php foreach ($data as $post) { ?>
	<article class="post">
		<header>
			<h1><?php echo $post['Post']['title']; ?></h1>
		</header>
		<aside>
			<?php 
				echo __('By ') . $post['User']['lastname'] . ' ' . $post['User']['firstname']
				. __(' On ') . $this->Time->format($post['Post']['created'], '%B %e, %Y %H:%M %p');
			?>
		</aside>
		<p><?php echo $post['Post']['content']; ?></p>
	</article>
<?php } ?>