<?php echo $this->Html->css('footer'); ?>

<div class="footer-wrapper col-md-10 col-md-offset-1">
	<div class="footer-box" id="ariane">
		<?php 
			echo $this->Html->getCrumbs(
				'<span class="glyphicon glyphicon-chevron-right"></span>', 
				array('text' => '<span class="glyphicon glyphicon-home"></span>', 'escape' => false)
			); 	
		?>
		<div class="pull-right">
			<a href="#menu" id="gotop"><span>Go back to top</span><span class="glyphicon glyphicon-chevron-up"></span></a>
		</div>
	</div>
	<div class="footer-box" id="level-1">
		<article class="col-md-3 col-sm-4 col-xs-5">
			<header><?php echo __('Administrateur'); ?></header>
			<p><?php echo 'Fabrice Dautancourt'; ?></p>
			<p><span class="glyphicon glyphicon-envelope"></span>dautafab51@hotmail.fr</p>
		</article>
		<article class="col-md-3 col-sm-4 col-xs-5">
			<header><?php echo __('Developpeur'); ?></header>
			<p><?php echo 'Aur&eacute;lien Martel'; ?></p>
			<p><span class="glyphicon glyphicon-envelope"></span>aurelien.martel@gmail.com</p>
		</article>
	</div>
</div>