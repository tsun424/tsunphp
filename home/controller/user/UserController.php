<?php
	
	class UserController extends Controller{
		
		public function add(){
			
			$_REQUEST['aaa'] = array('Tom'=>'20','Lily'=>'27');
			$this->view = View::build("user/useraddview");
			//echo "add method is called.<br>";
			//$this->redirect("admin/admin");
		}
		public function init(){
			//echo "init is called.<br>";
		}
		public function mod(){
			$_REQUEST['aaa'] = array('Lucy'=>'21','Lily'=>'19');
			$this->view = View::build("testview");
		}
	}
?>