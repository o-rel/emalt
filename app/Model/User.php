<?php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
	public $name = 'User';
	
	public $belongsTo = 'Group';
	/*public $hasMany = array(
		'ClassMembership' => array(
			//'conditions' => array('Group.name' => 'students')
		)
	);*/
	
	public $hasMany = array('CoursesUser', 'Audio');
	
	public $actsAs = array('Search.Searchable');
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
				'Group.name LIKE' => '%' . $filter . '%'
			)
		);
		return $cond;
	}
	
	public $validate = array(
		'firstname' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A firstname is required'
			)
		),
		'lastname' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A lastname is required'
			)
		),
		'email' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'An email is required'
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'A user with this email address already exists'
			)
		),
		'password' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'message' => 'A password is required'
			)
		),
		'checkpwd' => array(
			'equltofield' => array(
				'rule' => array('equaltofield', 'password'),
				'message' => 'Require the same value to password'
			)
		)
	);
	
	public function equaltofield($check, $otherfield) {
		$fname = '';
		foreach ($check as $key => $value) {
			$fname = $key;
			break;
		}
		return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
	}

	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
    	return true;
	}
	
}
