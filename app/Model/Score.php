<?php

class Score extends AppModel {
	public $name = 'Score';
	
	public $belongsTo = array('User', 'Course', 'Audio');
	
	//public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'filter' => array('type' => 'query', 'method' => 'orConditions')
	);
	
	public function orConditions($data = array()) {
		$filter = $data['filter'];
		$cond = array(
			'OR' => array(
				$this->alias . '.lastname LIKE' => '%' . $filter . '%',
				$this->alias . '.firstname LIKE' => '%' . $filter . '%',
				$this->alias . '.email LIKE' => '%' . $filter . '%',
				$this->alias . '.group LIKE' => '%' . $filter . '%'
			)
		);
		return $cond;
	}

}

