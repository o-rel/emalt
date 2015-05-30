<div class="col-md-12">
	<ul class="head-list">
		<li><h1><?php echo __('Scores'); ?></h1></li>
		<li>
			<?php
				echo $this->Html->link(
					__('Add'),
					array('action' => 'add'),
					array('class' => 'btn btn-success')
				);
			?>
		</li>
	</ul>
</div>

<div class="col-md-5 pull-right">
	<?php foreach ($instruments as $v => $k) : ?>
		<button class="score_list instrument" onclick="hide_show('<?php echo $k['Instrument']['name']; ?>');">
			<?php echo $k['Instrument']['name']; ?>
		</button>
		<br />
		<div class="col-md-offset-1" id="<?php echo $k['Instrument']['name'];?>" style="display:none;">
			<?php
				$cycles = $this->requestAction(array('action' => 'get_cycles', $k['Instrument']['id']));
				foreach ($cycles as $cycle) :
			?>
					<button class="score_list cycle" onclick="hide_show('<?php echo $k['Instrument']['name']; ?>_<?php echo $cycle; ?>')">	
						<?php echo '|___' . __('Cycle ') . $cycle; ?>
					</button>
					<br />
					<div class="col-md-offset-1" id="<?php echo $k['Instrument']['name'] . '_' . $cycle; ?>" style="display:none;">
						<?php
							$years = $this->requestAction(array('action' => 'get_years', $k['Instrument']['id'], $cycle));
						?>
						<?php foreach ($years as $year) : ?>
							<button class="score_list year" onclick="hide_show('<?php echo $k['Instrument']['name']; ?>_<?php echo $cycle; ?>_<?php echo $year['Course']['year']; ?>')">
								<?php echo '|___' . __('Year ') . $year['Course']['year']; ?>
							</button>
							<br />
							<?php $scores = $this->requestAction(array('action' => 'get_scores', $year['Course']['id'])); ?>
							<?php
								if (!empty($scores)) {
							?>
									<div class="col-md-offset-1" id="<?php echo $k['Instrument']['name'] . '_' . $cycle . '_' . $year['Course']['year']; ?>" style="display:none;">
										<table>
										<?php foreach ($scores as $scoretab) : ?>
											<?php $score = current($scoretab); ?>
											<?php $id = 'score-list-' . $score['id']; ?>
											<button class="score_list score" id="score-list-<?php echo $score['id']; ?>">
												<?php echo '|___' . $score['name']; ?>
											</button>
											<?php
												$this->Js->get('#score-list-' . $score['id'])->event('click',
													$this->Js->request(
														array(
															'controller' => 'scores',
															'action' => 'ajaxGetScore',
															'admin' => true,
															$score['id']
														),
														array(
															'update' => '#score_content',
															'async' => true,
															'method' => 'post',
															'dataExpression' => true,
															'data' => $this->Js->serializeForm(array('inline' => true))
														)
													)
												);
											?>
											<br />
										<?php endforeach; ?>
										</table>
									</div>
						<?php
								}
							endforeach;
						?>
						
					</div>
			<?php
				endforeach;
			?>
		</div>
	<?php endforeach; ?>
</div>

<div class="col-md-7" id="score_content">
	<?php echo __('Please choose a score in the right list'); ?>
</div>



<?php	
	/*$this->Js->get('.score_list.score')->event('click',
		$this->Js->request(
			array(
				'controller' => 'scores',
				'action' => 'ajaxGetScore',
				'admin' => true,
			),
			array(
				'update' => '#score_content',
				'async' => true,
				'method' => 'post',
				'dataExpression' => true,
				'data' => $this->Js->serializeForm(array('inline' => true))
			)
		)
	);*/
	/*onclick="load_score('<?php echo $score['id']; ?>')"*/
?>