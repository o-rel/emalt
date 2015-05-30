<?php

App::uses('CoursesController', 'Controller');
App::uses('CoursesUsersController', 'Controller');

class UsersController extends AppController {
	public $helpers = array('Js' => array('Jquery'));
	public $components = array('RequestHandler', 'Search.Prg');
	public $paginate = array(
		'limit' => 15,
		'order' => array(
			'User.lastname' => 'asc'
		)
	);
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('logout', 'reset_password');
	}
	
	public function mail_on_create($firstname, $lastname, $email, $password) {
		$text = '<p>Bonjour ' . $lastname . ' ' . $firstname . ',</p>';
		$text.= '<p>vous avez été ajouté à la liste de nos utilisateurs par un administrateur et nous vous transmettons vos données de connection. </p> ';
		$text.= '<p>Login : ' . $email . '</p>';
		$text.= '<p>Mot de passe : ' . $password . '</p>';
		$text.= '<p>Nous vous recommandons vivement de changer votre mot de passe à votre première connexion.</p>';
		$text.= '<p>Merci.</p>';
		return $text;
	}
	
	public function mail_on_reset($firstname, $lastname, $email, $password) {
		$text = '<p>Bonjour ' . $lastname . ' ' . $firstname . ',</p>';
		$text.= '<p>vous avez demandé à remettre à zéro votre mot de passe et nous vous transmettons vos nouvelles données de connection.</p> ';
		$text.= '<p>Login : ' . $email . '</p>';
		$text.= '<p>Mot de passe : ' . $password . '</p>';
		$text.= '<p>Nous vous recommandons vivement de changer votre mot de passe à votre première connexion.</p>';
		$text.= '<p>Merci.</p>';
		return $text;
	}
	
	public function reset_password() {
		$this->layout = 'login';
		if ($this->request->is('post')) {
			$email = $this->request->data['User']['email'];
			$user = $this->User->findByEmail($email);
			
			
			if (empty($user)) {
				$this->Session->setFlash(__('We couldn\'t find your email address in our database !'), 'flash_danger');
			} else {
				$this->User->id = $user['User']['id'];
				$new_pwd = $this->randomize_password(10);
				$this->User->password = $new_pwd;
				$this->User->verified = 0;
				$this->User->save($this->User);
				$content = $this->mail_on_reset($user['User']['firstname'], $user['User']['lastname'], $email, $new_pwd);
				$this->send_password($email, $content);
				$this->Session->setFlash(__('Your password has been reseted, please check your mailbox.'), 'flash_success');
				$this->redirect(array('action' => 'login'));
			}
		}
		
	}
	
	public function admin_resetpwd() {
		$new_pwd = $this->randomize_password(10);
		$this->set('data', $new_pwd);
		$this->send_password('aurelien.martel@gmail.com', $new_pwd);
	}
	
	public function admin_index() {
		$this->Paginator->settings = $this->paginate;
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this->User->parseCriteria($this->Prg->parsedParams());
		$data = $this->Paginator->paginate('User');
		$this->set('data', $data);
		$this->set('nbstudents', $this->User->find('count', array('conditions' => array('Group.name' => 'students'))));
		$this->set('nbadmins' , $this->User->find('count', array('conditions' => array('Group.name' => 'administrator'))));
	}
	
	public function admin_view($id = null) {
		if (!$id) {
			throw new NotFoundException (__('Invalid user'));
		}
			
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}		
		$this->set('data', $this->User->read(null, $id));
	}
	
	public function admin_add() {
		$this->set('groups', $this->User->Group->find('list', array('order' => array('Group.id DESC'))));
		//$this->set('instruments', $this->User->Instrument->find('list', array('order' => array('Instrument.name'))));
			
		if ($this->request->is('post')) {
			$this->User->create();
			$password = $this->randomize_password(10);
			$email = $this->request->data['User']['email'];
			$this->request->data['User']['password'] = $password;
			$content = $this->mail_on_create($this->request->data['User']['firstname'], $this->request->data['User']['lastname'], $email, $password);
			//debug($content);
			//die;
			if ($this->User->save($this->request->data)) {
				$this->send_password($email, $content);
				$this->Session->setFlash(__('The user has been added'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setflash(__('The user couldn\'t be added'), 'flash_danger');
			}
		}
	}
	
	public function edit() {
		$id	= $this->Session->read('User.id');
			
		if (!$id) {
			throw new notFoundException(__('Something went wrong, please logout and try again'));
		}
		
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The email has been saved'), 'flash_success');
				return $this->redirect(array('action' => 'edit'));
			}
			$this->Session->setFlash(__('The email could not be saved, please try again.'), 'flash_danger');
		} else {
			
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
	}
	
	public function change_password() {
		$id	= $this->Session->read('User.id');
			
		if (!$id) {
			throw new notFoundException(__('Something went wrong, please logout and try again'));
		}
		
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			$this->request->data['id'] = $id;
			$this->request->data['verified'] = TRUE;
			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Password has been saved'), 'flash_success');
				return $this->redirect(array('action' => 'edit'));
			}
			$this->Session->setFlash(__('Passwords don\'t match, please try again.'), 'flash_danger');
			return $this->redirect(array('action' => 'edit'));
		} else {
			
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
	}
	
	public function admin_edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid user'));
		}
			
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The user could not be saved, please try again.'), 'flash_danger');
		} else {
			$this->set('groups', $this->User->Group->find('list', array('order' => array('Group.id DESC'))));
			$this->set('courses', $this->User->CoursesUser->findAllByUserId($id, array(), array(), 0, 0, 2));
			$this->set('instruments', $this->User->CoursesUser->Course->Instrument->find('list', array('order' => array('Instrument.name ASC'))));
			//$this->set('instruments', $this->User->ClassMembership->Instrument->find('list', array('order' => array('Instrument.name'))));
			//$this->set('classmemberships', $this->User->ClassMembership->findAllByUserId($id, array(), array(), 0, 0, 1));
			
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
	}
	
	public function admin_delete($id = null) {
		//$this->request->onlyAllow('post');
		if (!$id) {
			throw new NotFoundException(__('Invalid user'));	
		}
		
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted'), 'flash_success');
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The user couldn\'t be deleted'), 'flash_danger');
		return $this->redirect(array('action' => 'index'));
	}
	
	public function login() {
		$this->layout = 'login';
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->write('User.id', $this->Auth->user('id'));
				$this->Session->write('User.group', $this->Auth->user('Group.name'));
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_connection', date(DATE_ATOM));
				if (!$this->Auth->user('verified')) {
					$this->Session->setFlash(__('We strongly recommand you to change your password'), 'flash_warning');
				}
				if ($this->Auth->user('Group.name') == 'administrator') {
					return $this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
				} else {
					return $this->redirect(array('controller' => 'posts', 'action' => 'index'));	
				}
			}
			$this->Session->setFlash(__('Invalid username or password, please try again'), 'flash_danger');
		}
	}
	
	public function admin_login() {
		$this->layout = 'login';
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->Session->write('User.id', $this->Auth->user('id'));
				$this->Session->write('User.group', $this->Auth->user('Group.name'));
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_connection', date(DATE_ATOM));
				if (!$this->Auth->user('verified')) {
					$this->Session->setFlash(__('We strongly recommand you to change your password'), 'flash_warning');
				}
				if ($this->Auth->user('Group.name') == 'administrator') {
					return $this->redirect(array('controller' => 'users', 'action' => 'index', 'admin' => true));
				} else {
					return $this->redirect(array('controller' => 'posts', 'action' => 'index'));	
				}
			}
			$this->Session->setFlash(__('Invalid username or password, please try again'), 'flash_danger');
		}
	}
	
	public function logout() {
		$this->Session->destroy();
		return $this->redirect($this->Auth->logout());
	}
	
	public function admin_logout() {
		$this->Session->destroy();
		return $this->redirect($this->Auth->logout());
	}
	
	public function log_redirect() {
		if ($this->Session->read('User.group') == 'administrator') {
			$this->redirect(array('action' => 'index', 'admin' => true));
		} else {
			$this->redirect(array('controller' => 'posts', 'action' => 'index', 'admin' => false));
		}
	}
	
	public function admin_log_redirect() {
		if ($this->Session->read('User.group') == 'administrator') {
			$this->redirect(array('action' => 'index', 'admin' => true));
		} else {
			$this->redirect(array('controller' => 'posts', 'action' => 'index', 'admin' => false));
		}
	}
	
	function ajax_cycles() {
		$this->set('options',
			$this->Course->find('list',
				array('conditions' => array('Course.instrument_id' => $this->data['CoursesUser']['id']))
			)
		);
		$this->render('/elements/ajax_dropdown');
	}
	
}