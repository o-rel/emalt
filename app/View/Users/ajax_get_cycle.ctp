<?php
// file: /views/page/ajax_get_users_pages.ctp

if(!empty($cycles)) {
	echo $form->input('cycle_id',array(
		'type'=>'select',
		'options'=>$cycles,
		'div'=>false,
		'name'=>'data[Cycle][cycle_id]'
	));
}
?>