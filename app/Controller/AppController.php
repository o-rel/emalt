<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array('Html', 'Bs3Helpers.Bs3Form');
	//public $helpers = array('Form' => array('className' => 'Bs3Helpers.Bs3Form'));
	public $components = array(
		'DebugKit.Toolbar',
		'Session',
		//'Security',
		'Paginator',
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'userModel' => 'User',
					'passwordHasher' => 'Blowfish',
					'fields' => array('username' => 'email', 'password' => 'password')	
				)
			),
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'loginRedirect' => array(
				'controller' => 'posts',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'unauthorizedRedirect' => array(
				'controller' => 'posts',
				'action' => 'index',
				'admin' => false
			),
			'authError' => '',
			'autoRedirect' => false
		)
	);
	
	public function beforeFilter() {
		//$this->Auth->allow('index', 'view');
		
		$this->Auth->authorize = 'Controller';
		
		if ((isset($this->params['prefix']) && ($this->params['prefix'] == 'admin'))) {
			$this->layout = 'admin';
		}
	}
	
	public function isAuthorized() {
		if ((isset($this->params['prefix']) && ($this->params['prefix'] == 'admin'))) {
			if ($this->Auth->user('Group.name') != 'administrator') {
				$this->Session->setFlash(__('You are not authorized to access that location'), 'flash_danger');
				return false;
				
				//$this->redirect($this->referer());
				
			}
		}
		return true;
	}

	public function sanitize($string) {
		$string = htmlentities($string, ENT_NOQUOTES, 'ISO-8859-15');
	    
	    $string = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $string);
	    $string = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $string); // pour les ligatures e.g. '&oelig;'
	    $string = preg_replace('#&[^;]+;#', '', $string); // supprime les autres caractères
	    
	    $string = str_replace(' ', '_', $string);
		
		return $string;
	}
	
	public function randomize_password($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	/*public function send_password($to=null, $message = null) {
		$subject = 'Inscription au site mes-partoches.com';
		
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers.= 'From: aurelien.martel@gmail.com';
		
		mail($to, $subject, $message, $headers); 
	}*/
	
	public function send_password($dest=null, $password = null) {
		$Email = new CakeEmail('mail_config');
		$Email->to($dest);
		$Email->subject('Inscription au site mes-partoches.com');
		$Email->replyTo('aurelien.martel@gmail.com');
		$Email->from('aurelien.martel@gmail.com');
		$Email->send($password);
	}
}