<?php

class CoursesUser extends AppModel {
	public $belongsTo = array('User', 'Course');


	public $validate = array(
		'instrument_id' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You should choose an instrument'
			)
		),
		'cycle' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You should choose a cycle'
			)
		),
		'year' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'You should choose a year'
			)
		)
	);
		
}