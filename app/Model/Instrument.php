<?php

App::uses('AppModel', 'Model');

class Instrument extends AppModel {
	public $name = 'Instrument';
	
	//public $hasMany = 'ClassMembership';
	public $hasMany = 'Course';
	
	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'filter' => array('type' => 'query', 'method' => 'orConditions')
	);
	
	public function orConditions($data = array()) {
		$filter = $data['filter'];
		$cond = array(
			'OR' => array(
				$this->alias . '.name LIKE' => '%' . $filter . '%'
			)
		);
		return $cond;
	}
}

?>