<?php

App::uses('AppModel', 'Model');

class Post extends AppModel {
	public $name = 'Post';
	
	public $belongsTo = 'User';
	
	public $validate = array();
	
	public $actsAs = array('Search.Searchable');
	public $filterArgs = array(
		'filter' => array('type' => 'query', 'method' => 'orConditions')
	);
	
	public function orConditions($data = array()) {
		$filter = $data['filter'];
		$cond = array(
			'OR' => array(
				$this->alias . '.title LIKE' => '%' . $filter . '%',
				$this->alias . '.content LIKE' => '%' . $filter . '%'
			)
		);
		return $cond;
	}
}
