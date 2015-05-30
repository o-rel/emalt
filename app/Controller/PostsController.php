<?php
class PostsController extends AppController {
	public $helpers = array('Js' => array('Jquery'));
	public $components = array('RequestHandler', 'Search.Prg');
	
	public $paginate = array(
		'limit' => 15,
		'order' => array(
			'Post.created' => 'desc'
		)
	);
	
	public $paginate_index = array(
		'limit' => 5,
		'order' => array(
			'Post.created' => 'desc'
		)
	);
	
	public function index() {
		$this->Paginator->settings = $this->paginate_index;
		//$data = $this->Post->find('all', array('order' => array('Post.created' => 'desc'), 'limit' => 3));
		$data = $this->Paginator->paginate('Post');
		$this->set('data', $data);
	}
	
	public function admin_index() {
		$this->Paginator->settings = $this->paginate;
		$this->Prg->commonProcess();
		$this->Paginator->settings['conditions'] = $this->Post->parseCriteria($this->Prg->parsedParams());
		$data = $this->Paginator->paginate('Post');
		$this->set('data', $data);
	}
	
	public function admin_add() {
		if($this->request->is('post')) {
			$this->Post->create();
			$this->request->data['Post']['user_id'] = $this->Auth->user('id');
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been correctly published'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The post couldn\'t be published'));
			}
		}
	}
	
	public function admin_view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->set('data', $this->Post->read(null, $id));
	}
	
	public function admin_edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Post->save($this->request->data)) {
				$this->Session->setFlash(__('The post has been correctly updated'), 'flash_success');
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The post couldn\'t be updated'));
		} else {
			$this->request->data = $this->Post->read(null, $id);
		}
	}
	
	public function admin_delete($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->Post->delete()) {
			$this->Session->setFlash(__('The post has been deleted'), 'flash_success');
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The post couldn\'t be deleted'), 'flash_danger');
		return $this->redirect(array('action' => 'index'));
	}
}
?>