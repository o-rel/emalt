<?php

class AudiosController extends AppController {
	public $helpers = array('Js' => array('Jquery'));
	public $components = array('RequestHandler', 'Search.Prg');
	
	public $paginate = array(
		'limit' => 15,
		'order' => array(
			'Post.created' => 'desc'
		)
	);
	
	public function admin_index() {
		$this->Paginator->settings = $this->paginate;
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this->Audio->parseCriteria($this->Prg->parsedParams());
		$data = $this->Paginator->paginate('Audio');
		$this->set('data', $data);
	}
	
	public function admin_add() {
		//$this->set('instruments', $this->Audio->Score->Course->Instrument->find('list', array('order' => array('Instrument.name ASC'))));
	
		if ($this->request->is('post')) {
			//debug ($this->request->data);
			//die;
			if (!empty($this->request->data['Audio']['upload']['name'])) {
				$file = $this->request->data['Audio']['upload'];
				
				$ext = substr(strtolower(strrchr($file['name'], '.')), 1);
				$arr_ext = array('ogg', 'mp3');
				
				$path = WWW_ROOT . 'files' . DS . 'audios';
				$url = 'audios/';
				
				if (in_array($ext, $arr_ext)) {
					$filename = $this->request->data['Audio']['name'];
					
					$random_name = $this->randomize_password(10);
					
					if (file_exists($path . DS . $random_name . '.' . $ext)) {
						$this->Session->setFlash(__('An audio file with this name already exists'), 'flash_danger');
						return $this->redirect(array('action' => 'add'));
					}
					
					if (!file_exists($path)) {
						mkdir($path, 0711, TRUE);
					}
					
					if (move_uploaded_file(
						$file['tmp_name'], $path . DS . $random_name . '.' . $ext
					)) {
						$this->Audio->create();
						
						$this->request->data['Audio']['user_id'] = $this->Auth->user('id');
						$this->request->data['Audio']['extension'] = $ext;
						$this->request->data['Audio']['random_name'] = $random_name . '.' . $ext;
						
						if ($this->Audio->save($this->request->data)) {
							$this->Session->setFlash(__('The audio file has been correctly uploaded'), 'flash_success');
							return $this->redirect(array('action' => 'index'));
						}
						$this->Session->setFlash(__('The audio file could\'nt be uploaded'), 'flash_danger');
					}
					$this->Session->setFlash(__('WRONG !!!'), 'flash_danger');
				}
				$this->Session->setFlash(__('Only mp3 or ogg files are accepted'), 'flash_danger');
			}
		}
	}

	public function admin_edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid audio file'));
		}
		
		$this->Audio->id = $id;
		if (!$this->Audio->exists()) {
			throw new NotFoundException(__('Invalid audio file'));
		}
		
		$this->set('instruments', $this->Audio->Score->Course->Instrument->find('list', array('order' => array('Instrument.name ASC'))));
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Audio->save($this->request->data)) {
				$this->Session->setFlash(__('The audio file has been correctly updated'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The audio file could not be updated'));
		} else {
			$this->request->data = $this->Audio->read(null, $id);
			
			$linked_scores = $this->Audio->Score->findAllByAudioId($id, array(), array(), 0, 0, 2);
			$this->set('scores', $linked_scores);
		}
	}
}
