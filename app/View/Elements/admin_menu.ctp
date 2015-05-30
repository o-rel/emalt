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
				<!--<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo __('Users'); ?> <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<?php 
								echo $this->Html->link(
									__('List'),
									array('controller' => 'users', 'action' => 'index', 'admin' => true, 'plugin' => false)
								);
							?>
						</li>
						<li>
							<?php
								echo $this->Html->link(
									__('Groups'),
									array()
								);
							?>
						</li>
					</ul>
				</li>-->
				<li>
					<?php 
						echo $this->Html->link(
							__('Users'),
							array('controller' => 'users', 'action' => 'index', 'admin' => true, 'plugin' => false)
						);
					?>
				</li>
				<li>
					<?php 
						echo $this->Html->link(
							__('Courses'),
							array('controller' => 'courses', 'action' => 'index', 'admin' => true, 'plugin' => false)
						);
					?>
				</li>
				<li>
					<?php
						echo $this->Html->link(
							__('Instruments'),
							array('controller' => 'instruments', 'action' => 'index', 'admin' => true, 'plugin' => false)
						);
					?>
				</li>
				<li>
					<?php
						echo $this->Html->link(
							__('Scores'),
							array('controller' => 'scores', 'action' => 'index', 'admin' => true, 'plugin' => false)
						);
					?>
				</li>
				<li>
					<?php
						echo $this->Html->link(
							__('Posts'),
							array('controller' => 'posts', 'action' => 'index', 'admin' => true, 'plugin' => false)
						);
					?>
				</li>
				<li>
					<?php
						echo $this->Html->link(
							__('Audio files'),
							array('controller' => 'audios', 'action' => 'index', 'admin' => true, 'plugin' => false)
						);
					?>
				</li>
			</ul>
			<ul class="nav navbar-nav pull-right">
				<li>
					<?php
						echo $this->Html->link(
							__('User panel'),
							array('controller' => 'posts', 'action' => 'index', 'admin' => false, 'plugin' => false)
						);
					?>
				</li>
				<li>
					<?php
						echo $this->Html->link(
							__('Logout'),
							array('controller' => 'users', 'action' => 'logout', 'admin' => false, 'plugin' => false)
						);
					?>
				</li>
			</ul>
		</div>
	</div>
</nav>
