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
     *  28-11-2015          Xiaoming Yang       delete useless comment
	*/
	
	class Controller{
		
		protected $view;
		
		/**
		*	redirect the request
		*	
		*	$location format:
		*					 1. "index"	-- redirect to index method of current module
		*					 2. "user/index" -- redirect to index method of user module
		*/
		public function redirect($location){
			$location = rtrim($location,"/");
			$url = "";
			if(strpos($location,"/")){
				$url = $_SERVER['SCRIPT_NAME']."/".$location;
			}else{
				$url = dirname($_SERVER['REQUEST_URI'])."/".$location;
			}
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

			if($this->view instanceof View){
				require $this->view->viewFile;
			}
		}
	}
?>