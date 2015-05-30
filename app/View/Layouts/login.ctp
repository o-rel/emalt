<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap');
		echo $this->Html->css('default');
		echo $this->Html->css('login');
		
		echo $this->Html->script('jquery');
		echo $this->Html->script('bootstrap.min');
		echo $this->Html->script('js');
		//echo $this->Html->script('common');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="header">
		<!--<div id="logbar-container">
			login logout
		</div>-->
	</div>
	<div id="container" class="col-md-12 col-sm-12 col-xs-12">
		
		<!--<div id="blanket" style="display:none;"></div>
		<div id="popUpDiv" style="display:none;">
			<?php
				echo $this->Form->create('User', array('action' => 'reset_password'));
					echo $this->Form->input('email', array('placeholder' => __('Email'), 'class' => 'form-control', 'div' => 'col-sm-12 loginform', 'label' => array('class' => 'sr-only')));
					echo '<button class="btn btn-sm btn-danger pull-right forgot loginform" id="closeLink">' . __('Nevermind') . '</button>';
				echo $this->Form->submit(__('Reset'), array('class' => 'btn btn-sm btn-primary'));
			?>
		</div>	-->
		
		<div id="content-wrapper" class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">			
			<?php echo $this->fetch('content'); ?>
			
			<div id="banner" class="col-md-8 col-sm-12 col-xs-12">
				<?php echo $this->Html->image('banner.jpg', array('class' => 'col-xs-12 col-md-12 col-sm-12 img')); ?>
			</div>
			
		</div>
	</div>
	<div id="footer" class="panel-footer col-sm-12">
		<?php echo $this->element('footer'); ?>
	</div>
	<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>
