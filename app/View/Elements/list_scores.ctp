<div class="col-md-offset-1">
	<?php debug($k); ?>
	<?php if (!empty($k['Score'])) { ?>
		<table>
			<?php foreach ($k['Score'] as $score) : ?>
				<tr>
					<td><?php echo $score['name']; ?></td>
				</tr>
			<?php endforeach ; ?>
		</table>
	<?php } ?>
</div>