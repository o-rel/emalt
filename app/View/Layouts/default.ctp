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
		<div id="menu-container">
			<div id="menu" class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
				<?php echo $this->element('menu'); ?>
			</div>
		</div>
	</div>
	<div id="container" class="col-md-12 col-sm-12 col-xs-12">
		<div id="content-wrapper" class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
			
			<aside class="col-md-4 col-sm-12 col-xs-12 pull-right">
				<?php echo $this->fetch('aside'); ?>
			</aside>
			
			<div id="content" class="col-md-8 col-sm-12 col-xs-12">
				<?php echo $this->Session->flash(); ?>
	
				<?php echo $this->fetch('content'); ?>
			</div>
			
			<div id="main-aside" class="col-md-4 pull-right col-sm-12 col-xs-12">
				
				<!--<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;height=400&amp;wkst=2&amp;bgcolor=%23ffffff&amp;src=aurelien.martel%40gmail.com&amp;color=%238C500B&amp;ctz=Europe%2FParis" 
					style=" border-width:0 " width="100%" height="400" frameborder="0" scrolling="no">	
				</iframe>-->
				
				<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showCalendars=0&amp;showTz=0&amp;height=600&amp;wkst=1&amp;bgcolor=%23e9eaed&amp;src=30nei2fn1mpv34kd1aot2en458%40group.calendar.google.com&amp;color=%232952A3&amp;src=49bic8ua9qs3n16ambkb5s5ts0%40group.calendar.google.com&amp;color=%23711616&amp;ctz=Europe%2FBrussels" style=" border-width:0 " width="100%" height="400" frameborder="0" scrolling="no"></iframe>
			</div>
		</div>
	</div>
	<div id="footer" class="panel-footer col-sm-12">
		<?php echo $this->element('footer'); ?>
	</div>
	<?php echo $this->Js->writeBuffer(); ?>
</body>
</html>
