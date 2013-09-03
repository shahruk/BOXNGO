<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

App::uses('Sanitize', 'Utility');
class AppController extends Controller {
	public $uses = array('Autologin', 'User', 'Category', 'Shop', 'Order', 'School', 'Message', 'Thread', 'NotificationItem', 'ShopSearch');
	public $components = array('UserLogin', 'Cookie', 'Auth', 'Security' => array('csrfCheck' => false), 'Session');
	public $helpers = array('Form', 'Time');

	public function beforeFilter(){
		$a = $this->Shop->find("all", array("limit" => 1));
		/*for($i = 0; $i < count($a); $i++){
			$data['user_id'] = $a[$i]['User']['id'];
			$data['ShopSearch']['shop_id'] = $a[$i]['Shop']['id'];
			$data['ShopSearch']['image'] = $a[$i]['Image'][0]['url'];
			$data['ShopSearch']['name'] = $a[$i]['Shop']['name'];
			$data['ShopSearch']['description'] = $a[$i]['Shop']['description'];
			$data['ShopSearch']['full_url'] = $a[$i]['Shop']['full_url'];
			$data['ShopSearch']['display_name'] = $a[$i]['User']['display_name'];
			$this->ShopSearch->save($data);
			$this->Shop->delete(array('Shop.id' => $a[$i]['Shop']['id']));
			
		}*/
		debug($this->ShopSearch->find("all"));
		parent::beforeFilter();
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'index');
		$this->Auth->authenticate = array('Form', 'all' => array('scope' => array('User.banned' => 0)));
		$this->set("layoutCategories", $this->Category->findNonEmpty());
		$cookie = $this->Cookie->read('al');
		if(!empty($cookie) && !$this->Auth->loggedIn())
			$this->Auth->login($this->UserLogin->checkUser($cookie, $this->Autologin->find("first", array("conditions" => array("Autologin.hash" => $cookie)))));
		if($this->Auth->loggedIn()){
			$user = $this->User->read(NULL, $this->Auth->user('id'));
			if(!$user['User']['seller_country'] && !($this->params['controller'] == "dashboards")){
				$this->Session->setFlash("Our site has changed and we just need a bit more information from you! Please put in your location.", "flash_success");
				$this->redirect(array('controller' => 'dashboard', 'action' => 'manageaccount'));
			}
			//debug($this->NotificationItem->save($data));
			$this->set("notificationItems",Cache::read('notifications.'.$this->Auth->user('id'), 'long'));
			$this->set("notifications", $this->Order->getNotifications($this->Auth->user('id')));
			$this->set("messages", $this->Thread->getUserMessages($this->Auth->user('id')));
			
			$this->set("auth", $user['User']);
		}
		//Debug Function
		/*if($this->Auth->user('role') == "admin"){
			$user = $this->User->read(NULL, 2798);
			$this->Auth->login($user['User']);
		} */
	}

	public function sendEmail($to="shahruksemail@gmail.com",$subject="TEST",$template="default", $variables=NULL){
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail('default');
		$email->from(array('shahruk@theboxngo.com' => 'BOXNGO'))
		->to($to)
		->subject($subject)
		->template($template, 'default')
		->emailFormat('html');
		$email->viewVars(array("domain" => "http://theboxngo.com/", "variables" => $variables));
		$email->send();

	}

	public function sendTradeEmail($to, $from, $subject, $listingId, $message, $contact){
		App::uses('CakeEmail', 'Network/Email');
		$email = new CakeEmail('default');
		$email->subject($subject)
		->template('default', 'trade')
		->from($from)
		->to($to)
		->emailFormat('html');
		$email->viewVars(array("message" => nl2br(h($message)), "contact" => nl2br(h($contact)), "domain" => "http://theboxngo.com/", "listing" => $listingId));
		$email->send();


	}
}
