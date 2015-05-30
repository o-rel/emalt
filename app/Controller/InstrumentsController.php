<?php

class InstrumentsController extends AppController {
	public $helpers = array('Html');
	public $components = array('Paginator', 'Search.Prg');
	
	public $paginate = array(
		'limit' => 15,
		'order' => array(
			'Instrument.name' => 'asc'
		)
	);
	
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	public function admin_index() {
		$this->Paginator->settings = $this->paginate;
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this->Instrument->parseCriteria($this->Prg->parsedParams());
		$data = $this->Paginator->paginate('Instrument');
		$this->set('data', $data);
	}
	
	public function admin_view($id = null) {
		
	}
	
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Instrument->create();
			if ($this->Instrument->save($this->request->data)) {
				$this->Session->setFlash(__('The instrument has been saved'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The instrument couldn\'t be saved'), 'flash_danger');
			}
		}
	}
	
	public function admin_edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid instrument'));
		}
			
		$this->Instrument->id = $id;
		if (!$this->Instrument->exists()) {
			throw new NotFoundException(__('Invalid instrument'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Instrument->save($this->request->data)) {
				$this->Session->setFlash(__('The instrument has been saved'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
				__('The instrument could not be saved, please try again.'),
				'flash_danger'
			);
		} else {
			$this->request->data = $this->Instrument->read(null, $id);
			
			$this->Paginator->settings = array(
				'limit' => 10,
				'conditions' => array('Course.instrument_id = ' => $id),
				'order' => array(
					'Course.cycle' => 'asc',
					'Course.year' => 'asc'
				)
			);
			$courses_data = $this->Paginator->paginate('Course');
			
			$courses = $this->Instrument->Course->findAllByInstrumentId($id, array('Course.id'), array('Course.cycle' => 'asc', 'Course.year' => 'asc'), 0, 0, 0);
			
			$students = array();
			foreach ($courses as $v => $k) {
				//TODO if user.firstname+lastname !in_array($students) add to students
				
				//debug($this->Instrument->Course->CoursesUser->findAllByCourseId($k['Course']['id']));
				$students = array_merge($this->Instrument->Course->CoursesUser->findAllByCourseId($k['Course']['id']), $students);
			}
			
			$this->set('courses', $courses_data);
			$this->set('students', $students);
		}
	}
	
	public function admin_delete($id = null) {
		$this->request->onlyAllow('get');
		
		$this->Instrument->id = $id;
		if (!$this->Instrument->exists()) {
			throw new NotFoundException(__('Invalid instrument'));
		}
		if ($this->Instrument->delete()) {
			$this->Session->setFlash(__('The instrument has been deleted'), 'flash_success');
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The instrument couldn\'t be deleted'), 'flash_danger');
		return $this->redirect(array('action' => 'index'));
	}
}