<?php

class CoursesController extends AppController {
	public $helpers = array('Js' => array('Jquery'));
	public $components = array('RequestHandler', 'Search.Prg');
		
	public $paginate = array(
		'limit' => 15,
		'order' => array(
			'Course.instrument_id' => 'asc',
			'Course.cycle' => 'asc',
			'Course.year' => 'asc'
		)
	);
		
	public function admin_index() {
		$this->Paginator->settings = $this->paginate;
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this->Course->parseCriteria($this->Prg->parsedParams());
		$data = $this->Paginator->paginate('Course');
		$this->set('data', $data);
	}
	
	public function admin_add($instrument_id = null) {
		if (!empty($instrument_id)) {
			$instruments = $this->Course->Instrument->find('list', array('conditions' => array('id' => $instrument_id)));
		} else {
			$instruments = $this->Course->Instrument->find('list', array('order' => 'Instrument.name ASC'));
		}
		
		$this->set('instruments', $instruments);
	
		if ($this->request->is('post')) {
			$this->Course->create();
			if ($this->Course->save($this->request->data)) {
				$this->Session->setFlash(__('The course has been added'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The course couldn\'t be added'), 'flash_danger');
			}
		}
	}
	
	public function admin_view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid course'));
		}
		
		$this->Course->id = $id;
		if (!$this->Course->exists()) {
			throw new NotFoundException(__('Invalid course'));
		}
		$this->set('data', $this->Course->read(null, $id));
	}
	
	public function admin_edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid course'));
		}
		
		$this->Course->id = $id;
		if(!$this->Course->exists()) {
			throw new NotFoundException(__('Invalid course'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Course->save($this->request->data)) {
				$this->Session->setFlash(__('The course has been saved'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The course couldn\'t be saved'), 'flash _danger');
		} else {
			$this->set('instruments', $this->Course->Instrument->find('list', array('order' => array('Instrument.name ASC'))));
			$this->request->data = $this->Course->read(null, $id);
			
			$this->Paginator->settings = array(
				'limit' => 0,
				'conditions' => array('CoursesUser.course_id = ' => $id),
				'order' => array(
					'User.lastname' => 'asc',
					'User.firstname' => 'asc'
				)
			);
			$students = $this->Paginator->paginate('CoursesUser');
			
			$this->set('students', $students);
			
			$this->Paginator->settings = array(
				'limit' => 0,
				'conditions' => array('Score.course_id = ' => $id),
				'order' => array(
					'Score.name' => 'asc'
				),
				'recursive' => -1
			);
			
			$scores = $this->Paginator->paginate('Score');
			
			$this->set('scores', $scores);
		}
	}
	
	public function admin_delete($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid course'));
		}
		
		$this->Course->id = $id;
		if (!$this->Course->exists()) {
			throw new NotFoundException(__('Invalid course'));
		}
		if ($this->Course->delete()) {
			$this->Session->setFlash(__('The course has been deleted'), 'flash_success');
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The course couldn\'t be deleted'), 'flash_danger');
		return $this->redirect(array('action' => 'index'));
	}
	
	
}