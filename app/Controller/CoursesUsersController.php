<?php

class CoursesUsersController extends AppController {
	
	public function admin_add() {
		if ($this->request->is('post')) {
			//debug($this->request->data);
			//die;
				
			$user_id = $this->request->data['CoursesUser']['user_id'];
			$instrument_id = $this->request->data['CoursesUser']['instrument_id'];
			$cycle = $this->request->data['CoursesUser']['cycle'];
			$year = $this->request->data['CoursesUser']['year'];
			$course_id = $this->CoursesUser->Course->find(
				'first',
				array(
					'conditions' => array(
						'instrument_id' => $instrument_id,
						'cycle' => $cycle,
						'year' => $year
					),
					'fields' => array(
						'Course.id'
					),
					'recursive' => -1
				)
			);
			//debug($course_id);
			//die;
			if (!empty($course_id)) {
				$this->CoursesUser->create(array());
				$save = array('CoursesUser' => array('user_id' => $user_id, 'course_id' => $course_id['Course']['id']));
				if ($this->CoursesUser->save($save)) {
					$this->Session->setFlash(__('The course has been correctly linked'), 'flash_success');
					return $this->redirect(array('controller' => 'users', 'action' => 'edit', $user_id));
				} else {
					$this->Session->setFlash(__('The course couldn\'t be linked'), 'flash_danger');
					return $this->redirect(array('controller' => 'users', 'action' => 'edit', $user_id));
				}
			} else {
				$this->Session->setFlash(__('The course doest\'t exist'), 'flash_danger');
				return $this->redirect(array('controller' => 'users', 'action' => 'edit', $user_id));
			}
		}		
	}

	public function admin_delete($id, $user_id) {
		//$this->request->onlyAllow('post');
		if (!$id) {
			throw new NotFoundException(__('Invalid link'));	
		}
		
		$this->CoursesUser->id = $id;
		if (!$this->CoursesUser->exists()) {
			throw new NotFoundException(__('Invalid link'));
		}
		if ($this->CoursesUser->delete()) {
			$this->Session->setFlash(__('The student has been deleted from the course'), 'flash_success');
			return $this->redirect(array('controller' => 'users', 'action' => 'edit', $user_id));
		}
		$this->Session->setFlash(__('The student couldn\'t be deleted form the course'), 'flash_danger');
		return $this->redirect(array('controller' => 'users', 'action' => 'edit', $user_id));
	}
	
	public function admin_addfromcourse($id) {
		if (!$id) {
			throw new NotFoundException(__('This course doesn\'t exist'));
		}
		
		$users = $this->CoursesUser->User->find('all', array('order' => array('User.lastname' => 'asc', 'User.firstname' => 'asc')));
		$this->set('users', $users);
		$data = array();
		$i = 0;
		foreach ($users as $v => $k) {
			$test = TRUE;
			foreach ($k['CoursesUser'] as $link) {
				if ($link['course_id'] == $id) {
					$test = FALSE;
				}
			}
			if ($test) {
				$data[$i] = $k['User'];
				$i++;
			}
		}
		$this->set('data', $data);
	}
	
	public function admin_addfromcourseuser($id, $course_id) {
		if (!$id) {
			throw new NotFoundException(__('This user doesn\'t exist'));
		}
		if (!$course_id) {
			throw new NotFoundException(__('This course doesn\'t exist'));
		}
		
		$this->CoursesUser->User->id = $id;
		if (!$this->CoursesUser->User->exists()) {
			throw new NotFoundException(__('This user doesn\'t exist'));
		}
		
		$this->CoursesUser->Course->id = $course_id;
		if (!$this->CoursesUser->Course->exists()) {
			throw new NotFoundException(__('This course doesn\'t exist'));
		}
		
		$this->CoursesUser->create();
		$save = array('CoursesUser' => array('user_id' => $id, 'course_id' => $course_id));
		if ($this->CoursesUser->save($save)) {
			$this->Session->setFlash(__('The user has been correctly linked to the course'), 'flash_success');
			return $this->redirect(array('controller' => 'CoursesUsers', 'action' => 'addfromcourse', $course_id));
		} else {
			$this->Session->setFlash(__('The user couldn\'t be linked to the course'), 'flash_danger');
			return $this->redirect(array('controller' => 'CoursesUsers', 'action' => 'addfromcourse', $course_id));
		}
		
	}
	
	public function admin_deletefromcourse($id, $course_id) {
		if (!$id) {
			throw new NotFoundException(__('Invalid link'));	
		}
		
		$this->CoursesUser->id = $id;
		if (!$this->CoursesUser->exists()) {
			throw new NotFoundException(__('Invalid link'));
		}
		if ($this->CoursesUser->delete()) {
			$this->Session->setFlash(__('The student has been deleted from the course'), 'flash_success');
			return $this->redirect(array('controller' => 'courses', 'action' => 'edit', $course_id));
		}
		$this->Session->setFlash(__('The student couldn\'t be deleted from the course'), 'flash_danger');
		return $this->redirect(array('controller' => 'courses', 'action' => 'edit', $course_id));
	}
	
	public function admin_ajaxGetCycles() {
		$this->request->onlyAllow('post');
		$instrument = current($this->request->data);
		$instrument_id = $instrument['instrument_id'];
		
		$cycles = $this->CoursesUser->Course->find('list', array(
			'conditions' => array('Course.instrument_id' => $instrument_id),
			'fields' => array('cycle'),
			'recursive' => -1,
			'group' => 'Course.cycle'
		));
		$this->set('ajaxCycles', $cycles);
		$this->layout = 'ajax';
	}
	
	public function admin_ajaxGetYears() {
		$this->request->onlyAllow('post');
		
		$cycle = current($this->request->data);
		$instrument_id = $cycle['instrument_id'];
		$cycle = $cycle['cycle'];
		
		$years = $this->CoursesUser->Course->find('list', array(
			'conditions' => array('Course.cycle' => $cycle, 'Course.instrument_id' => $instrument_id),
			'fields' => array('year'),
			'recursive' => -1,
			'group' => 'Course.year'
		));
		$this->set('ajaxYears', $years);
		$this->layout = 'ajax';
	}
}
