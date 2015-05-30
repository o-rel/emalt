<?php $this->Html->addCrumb(__('My scores'), array('controller' => 'scores', 'action' => 'index')); ?>

<?php
	$this->start('aside');
		echo '<div id="list_scores" class="col-xs-*">';
			foreach($data as $k) {
				echo '<button class="score_list instrument" onclick="hide_show(\'' . $k['Instrument']['name'] . '\');">';
					echo $k['Instrument']['name'] ;
				echo '</button><br />';
				
				echo '<div class="col-md-offset-1" id="' . $k['Instrument']['name'] . '" style="display:none;">';
				
					$cycles = $this->requestAction(array('action' => 'get_cycles', 'admin' => false, $k['Instrument']['id']));
					foreach ($cycles as $cycle) {
						echo '<button class="score_list cycle" onclick="hide_show(\'' . $k['Instrument']['name'] . '_' . $cycle . '\')">';
							echo '|___' . __('Cycle ') . $cycle;
						echo '</button><br />';
						echo '<div class="col-md-offset-1" id="' . $k['Instrument']['name'] . '_' . $cycle . '" style="display:none;">';
							
							$years = $this->requestAction(array('action' => 'get_years', 'admin' => false, $k['Instrument']['id'], $cycle));
							foreach ($years as $year) {
								echo '<button class="score_list year" onclick="hide_show(\'' . $k['Instrument']['name'] . '_' . $cycle . '_' . $year['year'] . '\')">';
									echo '|___' . __('Year ') . $year['year'];
								echo '</button><br />';
								
								$scores = $this->requestAction(array('action' => 'get_scores', 'admin' => false, $year['id']));
								if (!empty($scores)) {
									echo '<div class="col-md-offset-1" id="' . $k['Instrument']['name'] . '_' . $cycle . '_' . $year['year'] . '" style="display:none;">';
										echo '<table>';
											foreach ($scores as $scoretab) {
												$score = current($scoretab);
												$id = 'score-list-' . $score['id'];
												echo '<button class="score_list score" id="score-list-' . $score['id'] .'">';
													echo '|___' . $score['name'];
												echo '</button><br />';
												$this->Js->get('#score-list-' . $score['id'])->event('click',
													$this->Js->request(
														array(
															'controller' => 'scores',
															'action' => 'ajaxGetScore',
															'admin' => false,
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
											}
										echo '</table>';
									echo '</div>';
								}
							}
						echo '</div>';
					
					}
				echo '</div>';
			}
		echo '</div>';
	$this->end();
?>

<div class="col-md-12" id="score_content">
	<?php if (empty($data)) {
		echo __('You are not attempting to any course');
	} else {
		echo __('Please choose a score in the right list'); 
	} ?>
</div>