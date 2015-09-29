<?php
	/**
	*	The super controller of all real controller
	*	put the requested controller information to $_REQUEST['rController']
	*	put the requested method information to $_REQUEST['rMethod']
	************************************************************************
	*	@Author Xiaoming Yang
	*	@Initial date	28-09-2015 20:08
	************************************************************************
	*	update time			editor				updated information
	*/
	
	class Controller{
		
		protected $view;
		
		/**
		*	redirect to views
		*	
		*	$location format:
		*					 1. "index"	-- redirect to index method of current module
		*					 2. "user/index" -- redirect to index method of user module
		*/
		public function redirect($location){
			$location = rtrim($location,SLASH);
			$url = "";
			if(strpos($location,SLASH)){
				$url = $_SERVER['SCRIPT_NAME'].SLASH.$location;
			}else{
				$url = dirname($_SERVER['REQUEST_URI']).SLASH.$location;
			}
			//echo "url = $url";
			echo '<script>';
			echo 'location="'.$url.'"';
			echo '</script>'; 
		}
		
		/**
		*	the default requested method, sub class should override this method
		*
		*/
		public function index(){
			
		}
		
		/**
		*	the driven method of a controller, will be called in tsun.php to run a controller
		*
		*/
		
		public function run(){
			$method = (!empty($_REQUEST['rMethod']) ? $_REQUEST['rMethod'] : "index");
			/**
			*	try to call init method, init can be a filter method to do some check before real execution
			*	sub class should declare init method if it is needed
			*
			*/
			if(method_exists($this,"init")){
				$this->init();
			}
			if(method_exists($this,$method)){
				$this->$method();
			}else{
				echo "The reuqested method doesn't exist!";
			}
		}
		
		public function __destruct(){

			/* $_REQUEST['a']=1;
			include BASE_PATH."/home/controller/test.php"; */
			
			if($this->view instanceof View){
				require $this->view->viewFile;
			}
		}
	}
?>