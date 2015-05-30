
<?php
	$url = Router::fullbaseUrl() . $this->webroot . 'files/' . $ajaxScore['Score']['url'];
	$audio_url = Router::fullbaseUrl() . $this->webroot . 'files/audios/' . '07 - La Force du Destin.mp3';
?>	

<p>
	<?php
		echo ($ajaxScore['Score']['name']);			
	?>
	<a href="<?php echo $url;?>" target="_blank"><span class="glyphicon glyphicon-file" aria-hidden="true"></span></a>
	
	<!--<audio controls class="pull-right">
		<source src="<?php echo $audio_url;?>" type="audio/mpeg"/>
	</audio>-->
	
</p>

<div>	
	<?php
		if ($ajaxScore['Score']['extension'] == 'jpg') {
			echo $this->Html->image($url, array('alt' => $ajaxScore['Score']['name'], 'border' => '0', 'class' => 'col-md-12'));
		} 
		if ($ajaxScore['Score']['extension'] == 'pdf') { 
			echo '<embed width="100%" height="1150px" name="plugin" src="' . $url . '" type="application/pdf">';
		} ?>
</div>	