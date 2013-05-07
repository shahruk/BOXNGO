<?php
	class ApisController extends AppController{
		
		var $uses = array('Course', 'Favorite');
		
		public function beforeFilter(){
			parent::beforeFilter();
			$this->Auth->allow('autocomplete'); 
		}
		
		public function autocomplete(){
			$this->layout = "json";
			
			//Query format
			$queries = explode(" ", $this->request->query['query']);
			$regexString = "^";
			foreach($queries as $q => $val){
				$regexString .= "(?=.*".$val.")";
			}
			$regexString .= ".*$/i";
			
			$regex = new MongoRegex($regexString); 
			$courses = $this->Course->find("all", array("conditions" => array(
				"Course.full_text" => $regex)
			));
			foreach($courses as $a){
				$results['suggestions'][] = array('value' => $a['Course']['full_text'], 'data' => $a['Course']['code']);
			}
			$results['query'] = $this->request->query['query'];
			$this->set("results", $results);
		}

		public function checkfacebookuser(){
			$this->layout = "ajax";
			if(!$this->Auth->loggedIn())
				$this->set("result", "false");
			else{
				$fav = $this->Favorite->find("first", array("conditions" => array("Favorite.user_id" => $this->Auth->user('id'), "Favorite.shop_id" => $this->request->query['listingid'])));
				if(!empty($fav))
					$this->set("result", "false");
				elseif(!$this->Auth->loggedIn())
					$this->set("result", "false");
				else{
					$token = $this->Auth->user('facebook_access_token');
					if(!empty($token))
						$this->set("result", $token);
					else
						$this->set("result", "false");
				}
			}
		}
	}