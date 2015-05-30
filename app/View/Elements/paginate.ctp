<?php
	
	if ($this->Paginator->hasPage(2)) { ?>
	
	<?php
		$first = '&laquo;&laquo;';
		$previous = '&laquo;';
		$next = '&raquo;';
		$last = '&raquo;&raquo;';
	?>
		<ul class="pagination pagination-sm">
			<?php
				echo $this->Paginator->first(
					html_entity_decode($first, ENT_HTML5, 'ISO-8859-1'),
					array('class' => '', 'tag' => 'li'),
					null,
					array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a')
				);
				echo $this->Paginator->prev(
					html_entity_decode($previous, ENT_HTML5, 'ISO-8859-1'),
					array('class' => '', 'tag' => 'li'),
					null,
					array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a')
				);
		
				echo $this->Paginator->numbers(array( 
					'tag' => 'li', 
					'separator' => '', 
					'currentClass' => 'active', 
					'currentTag' => 'a',
					'modulus' => 6
				));
				echo $this->Paginator->next(
					html_entity_decode($next, ENT_HTML5, 'ISO-8859-1'),
					array('class' => '', 'tag' => 'li'),
					null,
					array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a')
				);
				echo $this->Paginator->last(
					html_entity_decode($last, ENT_HTML5, 'ISO-8859-1'),
					array('class' => '', 'tag' => 'li'),
					null,
					array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a')
				);
			?>
			
			
			<!--<li>
				<form role="form" class="form-inline" id="goForm" onsubmit="paginate_number(document.getElementById('goInput').value);" action="javascript:paginate_number(document.getElementById('goInput').value);">		
					<input name="page" class="form-control input-sm" placeholder="Go to" type="text" id="goInput" style="padding:5px;width:50px;">	
				</form>
			</li>-->
		</ul>

	<?php } 
	
?>