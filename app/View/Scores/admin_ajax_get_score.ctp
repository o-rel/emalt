<p>
	<?php
		echo ($ajaxScore['Score']['name']);
	?>
</p>

<?php
	$url = Router::fullbaseUrl() . $this->webroot . 'files/' . $ajaxScore['Score']['url'];
?>	
<div>	
	<?php
		if ($ajaxScore['Score']['extension'] == 'jpg') {
			echo $this->Html->image($url, array('alt' => $ajaxScore['Score']['name'], 'border' => '0', 'class' => 'col-md-12'));
		} 
		if ($ajaxScore['Score']['extension'] == 'pdf') { 
			echo '<embed width="100%" height="840px" name="plugin" src="' . $url . '" type="application/pdf">';
		} 
	?>
</div>	