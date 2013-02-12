<?php
	class AdminsController extends AppController{
		var $uses = array('Category', 'Shop', 'User', 'School');
		public function beforeFilter(){
			parent::beforeFilter();
			if($this->Auth->user('role') != "admin"){
				throw new NotFoundException("That page could not be found.");
			}else{
				$this->layout = "admin";
			}
		}
		
		public function index(){
		
		}
		
		public function modifyCategories($id=NULL, $delete=FALSE){
			if($delete == "delete"){
				if($this->Category->delete($id)){
					$this->Session->setFlash("Successfully deleted the category", "flash_success");
					$this->redirect('/admin/modifycategories');
				}else{
				}
			}else{
				$categories = $this->Category->find("all");
				$this->set("categories", $categories);
				if(($this->request->is('post') || $this->request->is('put')) && isset($this->request->data)){
					$this->Category->id = $id;
					if($this->Category->save($this->request->data)){
						$this->Session->setFlash("Successfully saved category!", "flash_success");
						$this->redirect($this->referer());
					}else{
						$this->Session->setFlash("Please check below for errors.", "flash_error");
					}
				}else{
					if(isset($id)){
						$category = $this->Category->read(NULL, $id);
						$this->set("category", true);
						$this->request->data = $category;
					}
				}
			}
		}
		
		public function assignCategories(){
			if($this->request->is('post') && !empty($this->request->data)){
				if($this->Shop->saveAll($this->request->data['Shop'])){
					$this->Session->setFlash("Those items have been assigned to their respective categories", "flash_success");
				}else{
				}
			}
			$listings = $this->Shop->find("all", array("conditions" => array("Shop.category_id" => NULL)));
			$categories = $this->Category->find("list");
			$this->set(compact('categories', 'listings'));
		}
		
		public function editSchools($domain=NULL){
			if($this->request->is('post')){
				if($this->School->save($this->request->data)){
					$this->Session->setFlash("Added that school!", "flash_success");
					$this->redirect($this->referer());
				}
			}elseif(isset($domain)){
				$this->request->data['School']['domain'] = $domain;
			}
			$this->User->recursive = 0;
			$users = $this->User->find("all");
			$count = 0;
			$undefinedSchools = array();
			for($i = 0; $i < count($users); $i++){
				if(!empty($users[$i]['User']['username'])){
					$school = $this->School->getSchool($users[$i]['User']['username']);
					if(empty($school)){
						$undefinedSchools[$count] = $this->School->getDomain($users[$i]['User']['username']);
						$count++;
					}
				}
			}
			$this->set("schools", $undefinedSchools);
		}
		
		public function markup(){ }
	}