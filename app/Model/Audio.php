<?php

Class Audio extends AppModel {
	public $name = 'Audio';
	
	public $hasMany = array('Score');
	
	public $belongsTo = array('User');
	
	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'filter' => array('type' => 'query', 'method' => 'orConditions')
	);
	
	public function orConditions($data = array()) {
		$filter = $data['filter'];
		$cond = array(
			'OR' => array(
				$this->alias . '.name LIKE' => '%' . $filter . '%',
				'User.email LIKE'  => '%' . $filter . '%',
				/*'User.firstname LIKE' => '%' . $filter . '%',
				'User.lastname LIKE' => '%' . $filter . '%'*/
			)
		);
	return $cond;
	}
}
