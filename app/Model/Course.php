<?php

class Course extends AppModel {
	public $name = 'Course';
	
	public $hasMany = array('CoursesUser', 'Score');
	public $belongsTo = 'Instrument';
	
	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'filter' => array('type' => 'query', 'method' => 'orConditions')
	);
	
	public function orConditions($data = array()) {
		$filter = $data['filter'];
		$cond = array(
			'OR' => array(
				'Instrument.name LIKE' => '%' . $filter . '%'
			)
		);
		return $cond;
	}
}
