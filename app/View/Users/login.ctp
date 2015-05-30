<?php $this->Html->addCrumb(__('Login'), array('controller' => 'users', 'action' => 'login')); ?>

<div class='col-md-4 col-sm-12 col-xs-12'>
	<?php
		echo $this->Session->flash();
		//$this->Auth->flash['params']['class'] = 'alert alert-block alert-danger alert-dismissable';
		echo $this->Session->flash('auth');
		//echo $this->Bs3Form->create('User', array('formStyle' => 'horizontal'));
		
	
		/*echo $this->Bs3Form->input('email', array('placeholder' => __('Email')));
		echo $this->Bs3Form->input('password', array('placeholder' => __('Password')));
		echo $this->Bs3Form->submit(__('Login'), array('class' => 'btn btn-primary'));
		//echo $this->Bs3Form->end(__('Login'));*/
		
		echo $this->Form->create('User');
		
			echo $this->Form->input('email', array('placeholder' => __('Email'), 'class' => 'form-control', 'div' => 'col-sm-12 loginform', 'label' => array('class' => 'sr-only')));
			echo $this->Form->input('password', array('placeholder' => __('Password'), 'class' => 'form-control', 'div' => 'col-sm-12 loginform', 'label' => array('class' => 'sr-only')));
			//echo '<button class="btn btn-sm btn-danger pull-right forgot loginform" id="forgot">' . __('Forgot your password ?') . '</button>';			
			echo $this->html->link(
				__('Forgot your password ?'),
				array('action' => 'reset_password'),
				array(
					'class' => 'btn btn-sm btn-danger pull-right forgot loginform',
					'id' => 'forgot'
				)
			);
			echo $this->Form->submit(__('Login'), array('class' => 'btn btn-sm btn-primary loginform'));
		echo $this->Form->end();
		
	?>
</div>