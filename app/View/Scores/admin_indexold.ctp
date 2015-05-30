<div class="col-md-12">
	<ul class="head-list">
		<li><h1><?php echo __('Scores list'); ?></h1></li>
		<li><button class="btn btn-success">
			<?php
				echo $this->Html->link(
					__('Add'),
					array('action' => 'add')
				);
			?>
		</button></li>
	</ul>
</div>
<?php debug($courses); ?>
<?php $current_instrument = ''; ?>
<?php $current_cycle = ''; ?>
<div class="col-md-9" id="score_content">
	
</div>
<div class="col-md-3">
<?php foreach ($courses as $v => $k) : ?>
		<div class="col-md-offset-0">
		<?php if ($k['Instrument']['name'] == $current_instrument) { ?>
			<?php if ($k['Course']['cycle'] != $current_cycle) { ?>
				<?php $current_cycle = $k['Course']['cycle']; ?>
				<div class="col-md-offset-1" id="<?php echo $k['Instrument']['name']; ?>" style="display:none;">
					<button class="score_list cycle" onclick="hide_show('<?php echo $current_instrument; ?>_<?php echo $current_cycle; ?>')">
						<?php echo __('Cycle ') . $k['Course']['cycle']; ?>
					</button>
					<div class="col-md-offset-1" id="<?php echo $k['Instrument']['name'] . '_' . $k['Course']['cycle']; ?>" style="display:none">
						<button class="score_list year" onclick="hide_show('<?php echo $current_instrument; ?>_<?php echo $current_cycle; ?>_<?php echo $k['Course']['year']; ?>')">
							<?php echo __('Year ') . $k['Course']['year']; ?>
						</button>
						<?php echo $this->element('list_scores', array('k' => $k)); ?>
					</div>
				</div>
			<?php } else { ?>
				<div class="col-md-offset-1" id="<?php echo $k['Instrument']['name']; ?>" style="display:none;">
					<div class="col-md-offset-1" id="<?php echo $k['Instrument']['name'] . '_' . $k['Course']['cycle']; ?>" style="display:none">
						<button class="score_list year" onclick="hide_show('<?php echo $current_instrument; ?>_<?php echo $current_cycle; ?>_<?php echo $k['Course']['year']; ?>')">
							<?php echo __('Year ') . $k['Course']['year']; ?>
						</button>
						<?php echo $this->element('list_scores', array('k' => $k)); ?>
					</div>
				</div>
			<?php } ?>
		<?php } else { ?>
			<?php $current_instrument = $k['Instrument']['name']; ?>
				<button class="score_list instrument" onclick="hide_show('<?php echo $current_instrument; ?>');">
					<?php echo $current_instrument; ?>
				</button>
				<br />
				<?php //echo $this->Html->link($current_instrument, array("javascript:void(0)"), array('escape' => false, 'onclick' => 'hide_show(\'' . $current_instrument . '\');')); ?>
				<div class="col-md-offset-1" id="<?php echo $k['Instrument']['name']; ?>" style="display:none;">
					<?php $current_cycle = $k['Course']['cycle']; ?>
					<button class="score_list cycle" onclick="hide_show('<?php echo $current_instrument; ?>_<?php echo $current_cycle; ?>')">
						<?php echo __('Cycle ') . $k['Course']['cycle']; ?>
					</button>
					<div class="col-md-offset-1" id="<?php echo $k['Instrument']['name'] . '_' . $k['Course']['cycle']; ?>" style="display:none">
						<button class="score_list year" onclick="hide_show('<?php echo $current_instrument; ?>_<?php echo $current_cycle; ?>_<?php echo $k['Course']['year']; ?>')">
							<?php echo __('Year ') . $k['Course']['year']; ?>
						</button>
						<?php echo $this->element('list_scores', array('k' => $k)); ?>
					</div>
				</div>
		<?php } ?>
		</div>
<?php endforeach ; ?>
</div>