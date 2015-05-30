<?php $audio_url = Router::fullbaseUrl() . $this->webroot . 'files/audios/' . $this->request->data['Audio']['random_name']; ?>

<div class="audio form">
	<fieldset class="col-md-4 col-sm-6 col-xs-12">
		<?php echo $this->Bs3Form->create('Audio', array('formStyle' => 'horizontal')); ?>
			<legend>
				<?php echo __('Audio file'); ?>
				<audio controls class="pull-right">
					<source src="<?php echo $audio_url;?>" type="audio/mpeg"/>
				</audio>
			</legend>
			<?php
				echo $this->Bs3Form->input('name');
				echo $this->Bs3Form->input('random_name', array('disabled' => true));
			?>
			
			<?php
				echo $this->Bs3Form->input('id', array('typep' => 'hidden'));
				echo $this->Bs3Form->submit(__('Save changes'), array('class' => 'btn btn-info col-sm-offset-3'));
			?>
		<?php echo $this->Bs3Form->end(array('type' => 'hidden')); ?>
	</fieldset>

	<fieldset class="col-md-4 col-sm-6 col-xs-12">
		<legend><?php echo __('Scores'); ?></legend>
		<table class="table table-stripped">
			<tr>
				
			</tr>
		</table>
		
		<?php 
		
			debug($scores);
			/*foreach ($scores as $k => $v) : 
				debug($k);
			endforeach;*/
		?>
	</fieldset>
</div>
