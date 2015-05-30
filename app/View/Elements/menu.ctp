<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li>
					<?php 
						echo $this->Html->link(
							__('Accueil'),
							array('controller' => 'posts', 'action' => 'index', 'plugin' => false)
						); 
					?>
				</li>
				<li>
					<?php
						echo $this->Html->link(
							__('My scores'),
							array('controller' => 'scores', 'action' => 'index', 'plugin' => false)
						);
					?>
				</li>
				<li>
					<?php
						echo $this->Html->link(
							__('My profile'),
							array('controller' => 'users', 'action' => 'edit', 'plugin' => false)
						);
					?>
				</li>
				<?php if ($this->Session->read('User.group') == 'administrator') { ?>
					<li>
						<?php
							echo $this->Html->link(
								__('Admin panel'),
								array('controller' => 'users', 'action' => 'index', 'admin' => true, 'plugin' => false)
							);
						?>
					</li>
				<?php } ?>
				</li>
				
			</ul>
			<ul class="nav navbar-nav pull-right">
				<li>
					<?php
						echo $this->Html->link(
							__('Logout'),
							array('controller' => 'users', 'action' => 'logout', 'plugin' => false)
						);
					?>
				</li>
			</ul>
		</div>
	</div>
</nav>