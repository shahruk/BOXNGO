<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';

/**
 * @var array
 */
	public $uses = array('Shop', 'Shopview', 'Collection', 'Category', 'Course');
	
	public function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allow('display', 'forums');
	}
/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;
		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		
		if($path[0] == "home"){
			$title_for_layout = "Online Selling Redefined";
			$this->Shopview->recursive = 1;
			$this->set("activity", $this->Shopview->find("all", array("order" => "Shopview.created DESC", "limit" => 24)));
			if($this->Auth->loggedIn()){		
				$this->Shop->recursive = 1;	
				$this->Collection->recursive = 1;
				//Top Picks
				$this->set("topPicks", $topPicks = $this->Shop->getCollectionItems($this->Collection->find("first", array("conditions" => array("Collection.short_name" => "homepage_users")))));
				//Recents
				$recents = array();
				$this->set("recentlyViewed", $recents = $this->Shop->getShopviewItems($this->Shopview->find("all", array("conditions" => array("Shopview.user_id" => $this->Auth->user('id')), "order" => "Shopview.created DESC", "limit" => 4))));
				
				$results = array();
				//Results and then add the category
				if(empty($recents[0]['Shop']))
					$recents[0] = $topPicks[0];
				$resultsTmp = $this->ShopSearch->find('all', array('conditions' => array('ShopSearch.canview' => 1), 'query' => array('flt' => array('fields' => array('ShopSearch.name^2', 'ShopSearch.description'), 'like_text' => $recents[0]['Shop']['name'])), 'limit' => 5));
				//Cuz 1st one = the original search
				for($i = 0; $i < 4; $i++){
					$results[$i] = $resultsTmp[$i+1];
				}
				for($i = 0; $i < count($results); $i++){
					$tmpCategory = $this->Category->read(NULL, $results[$i]['ShopSearch']['category_id']);
					$results[$i]['Category'] = $tmpCategory['Category'];
				}
				$this->set('similarItems', $results);
				$path[0] = "home_user";
				$this->set("recent", $this->Shop->getLatest());
			}else{
				$this->Collection->recursive = 3;
				$this->layout ="ajax";
			}
		}
		
		$this->set(compact('page', 'subpage', 'title_for_layout'));
		$this->render(implode('/', $path));
	}

}
