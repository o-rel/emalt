<?php

App::uses('CoursesController', 'Controller');
App::uses('AudiosController', 'Controller');

class ScoresController extends AppController {
	public $helpers = array('Js' => array('Jquery'));
	//public $components = array('RequestHandler');
	
	public function index() {
		$data = $this->Score->Course->CoursesUser->find('all', array('conditions' => array('CoursesUser.user_id' => $this->Session->read('User.id'))));
		$instrument_id = array();
		$courses = array();
		$i = 0;
		foreach ($data as $k) {
			$instrument_id[$i] = $k['Course']['instrument_id'];
			$courses[$i] = $k['Course'];
			$i++;
		}
		
		$data = $this->Score->Course->Instrument->find('all', array('recursive' => -1, 'conditions' => array('Instrument.id' => $instrument_id)));
		$this->set('data', $data);
	}
	
	public function admin_index() {
		$this->set('instruments', $this->Score->Course->Instrument->find('all', array('recursive' => 1, 'order' => array('Instrument.name' => 'asc'))));
	}
	
	public function get_cycles($instrument_id) {
		$data = $this->Score->Course->CoursesUser->find('all', array('conditions' => array('CoursesUser.user_id' => $this->Session->read('User.id'))));
		$cycles = array();
		$i = 0;
		foreach ($data as $k) {
			if ($k['Course']['instrument_id'] == $instrument_id) {
				$cycles[$i] = $k['Course']['cycle'];
				$i++;
			}
		}
		$cycles = array_unique($cycles);
		sort($cycles);
		return $cycles;
	}
	
	public function admin_get_cycles($instrument_id) {
		return $this->Score->Course->find('list', array('fields' => 'Course.cycle', 'group' => 'Course.cycle', 'order' => array('Course.cycle' => 'asc'), 'conditions' => array('instrument_id' => $instrument_id)));
	}
	
	public function get_years($instrument_id, $cycle) {
		$data = $this->Score->Course->CoursesUser->find('all', array('conditions' => array('CoursesUser.user_id' => $this->Session->read('User.id'))));
		$years = array();
		$i = 0;
		foreach ($data as $k) {
			if ($k['Course']['instrument_id'] == $instrument_id && $k['Course']['cycle'] == $cycle) {
				$years[$i] = $k['Course'];
				$i++;
			}
		}
		sort($years);
		return $years;
	}
	
	public function get_scores($course_id) {
		return $this->Score->find('all', array('order' => array('Score.name' => 'asc'), 'conditions' => array('course_id' => $course_id)));
	}
	
	public function admin_get_years($instrument_id, $cycle) {
		return $this->Score->Course->find('all', array('group' => 'Course.year', 'order' => array('Course.year' => 'asc'), 'conditions' => array('instrument_id' => $instrument_id, 'cycle' => $cycle)));
	}
	
	public function admin_get_scores($course_id) {
		return $this->Score->find('all', array('order' => array('Score.name' => 'asc'), 'conditions' => array('course_id' => $course_id)));
	}
	
	public function admin_add() {
		$this->set('instruments', $this->Score->Course->Instrument->find('list', array('order' => array('Instrument.name ASC'))));
		
		if ($this->request->is('post')) {
			
			$instrument_id = $this->request->data['Score']['instrument_id'];
			$cycle = $this->request->data['Score']['cycle'];
			$year = $this->request->data['Score']['year'];
			
			$instrument = $this->Score->Course->Instrument->find('first', array(
				'conditions' => array('Instrument.id' => $instrument_id),
				'recursive' => -1,
				'fields' => array('Instrument.name')
			));
			$instrument_name = $instrument['Instrument']['name'];
			$instrument_name = $this->sanitize($instrument_name);
			
			$course = $this->Score->Course->find('first', array(
				'conditions' => array(
					'Course.instrument_id' => $instrument_id,
					'Course.cycle' => $cycle,
					'Course.year' => $year
				),
				'fields' => array('Course.id'),
				'recursive' => -1
			));
			$course_id = $course['Course']['id'];
			
			if (!$course_id) {
				$this->Session->setFlash(__('This course doesn\'t exists'), 'flash_danger');
				return $this->redirect(array('action' => 'add'));
			}
			
			if (!empty($this->request->data['Score']['upload']['name'])) {
					
				$file = $this->request->data['Score']['upload'];
				
				$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
				$arr_ext = array('jpg', 'jpeg', 'pdf');
				
				$path = WWW_ROOT .'files' . DS . 'scores' . DS . $instrument_name . DS . $cycle . DS . $year;
				$url = 'scores/' . $instrument_name . '/' . $cycle . '/' . $year;
				
				if (in_array($ext, $arr_ext)) {
					
					$filename = $this->request->data['Score']['name'];
					$filename = $this->sanitize($filename);
					
					if (file_exists($path . DS . $filename . '.' . $ext)) {
						$this->Session->setFlash(__('This filename already exists for this course'), 'flash_danger');
						return $this->redirect(array('action' => 'add'));
					}
					
					if (!file_exists($path)) {
						mkdir($path, 0711, TRUE);
					}
					
					if(move_uploaded_file(
						$file['tmp_name'], $path . DS . $filename . '.' . $ext
					)) {
						$this->Score->create();
						
						$this->request->data['Score']['url'] = $url . '/' . $filename . '.' . $ext;
						$this->request->data['Score']['user_id'] = $this->Auth->user('id');
						$this->request->data['Score']['course_id'] = $course_id;
						$this->request->data['Score']['extension'] = $ext;
						
						if ($this->Score->save($this->request->data)) {
							$this->Session->setFlash(__('The score has been correctly uploaded'), 'flash_success');
							return $this->redirect(array('action' => 'index'));
						}
						$this->Session->setFlash(__('The score could\'nt be uploaded'), 'flash_danger');
					}
					$this->Session->setFlash(__('WRONG !!!'), 'flash_danger');
				}
				$this->Session->setFlash(__('Only jpg, jpeg or pdf files are accepted'), 'flash_danger');
			}
		}
	}

	public function admin_delete($id) {
		if (!$id) {
			throw new NotFoundException(__('Invalid user'));	
		}
		
		$this->Score->id = $id;
		if (!$this->Score->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		$file = $this->Score->findById($id);
		
		$instrument_id = $file['Course']['instrument_id'];
		
		$instrument = $this->Score->Course->Instrument->find('first', array(
			'conditions' => array('Instrument.id' => $instrument_id),
			'recursive' => -1,
			'fields' => array('Instrument.name')
		));
		$instrument_name = $instrument['Instrument']['name'];
		$instrument_name = $this->sanitize($instrument_name);
		
		$cycle = $file['Course']['cycle'];
		$year = $file['Course']['year'];
		
		$filename = $file['Score']['name'];
		$ext = '.' . $file['Score']['extension'];
		
		$filename = $this->sanitize($filename);
	 	
		$path = WWW_ROOT .'files' . DS . 'scores' . DS . $instrument_name . DS . $cycle . DS . $year . DS . $filename . $ext;
		
		if ($this->Score->delete() && unlink($path)) {
			$this->Session->setFlash(__('The score has been deleted'), 'flash_success');
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The score couldn\'t be deleted'), 'flash_danger');
		return $this->redirect(array('action' => 'index'));
	}
	
	public function admin_deleteFromCourses($id, $courseId) {
		if (!$id) {
			throw new NotFoundException(__('Invalid user'));	
		}
		
		$this->Score->id = $id;
		if (!$this->Score->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		$file = $this->Score->findById($id);
		
		$instrument_id = $file['Course']['instrument_id'];
		
		$instrument = $this->Score->Course->Instrument->find('first', array(
			'conditions' => array('Instrument.id' => $instrument_id),
			'recursive' => -1,
			'fields' => array('Instrument.name')
		));
		$instrument_name = $instrument['Instrument']['name'];
		$instrument_name = $this->sanitize($instrument_name);
		
		$cycle = $file['Course']['cycle'];
		$year = $file['Course']['year'];
		
		$filename = $file['Score']['name'];
		$ext = '.' . $file['Score']['extension'];
		
		$filename = $this->sanitize($filename);
	 	
		$path = WWW_ROOT .'files' . DS . 'scores' . DS . $instrument_name . DS . $cycle . DS . $year . DS . $filename . $ext;
		 
		if (unlink($path) && $this->Score->delete()) {
			$this->Session->setFlash(__('The score has been deleted'), 'flash_success');
			return $this->redirect(array('controller' => 'courses', 'action' => 'edit', $courseId));
		}
		$this->Session->setFlash(__('The score couldn\'t be deleted'), 'flash_danger');
		return $this->redirect(array('controller' => 'courses', 'action' => 'edit', $courseId));
	}

	public function ajaxGetScore($id) {
		$this->Score->recursive = 2;
		$score = $this->Score->read(null, $id);
		$this->set('ajaxScore', $this->Score->read(null, $id));
		$this->layout = null;
	}

	public function admin_ajaxGetScore($id) {
		$this->Score->recursive = 2;
		$score = $this->Score->read(null, $id);
		$this->set('ajaxScore', $this->Score->read(null, $id));
		$this->layout = null;
	}
	
	
}
