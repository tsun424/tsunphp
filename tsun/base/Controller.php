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
     *  07-01-2016          Xiaoming Yang       add log function
	*/
	
	class Controller{
		
		protected $view;
		protected $log;
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

        public function init(){
            //instantiate the log object, sub controllers can use it to record logs directly
            $this->log = new Logger();
        }
		
		/**
		*	the driven method of a controller, will be called in tsun.php to run a controller
		*
		*/
		
		public function run(){
			$method = (!empty($_REQUEST['rMethod']) ? $_REQUEST['rMethod'] : "index");

            //check the session to confirm user validation
            if(!empty($_REQUEST['rController']) && $_REQUEST['rController'] != 'login'){
                session_start();
                if(!isset($_SESSION['user'])) {
                    self::redirect('login/index');
                }
            }

			//try to call init method to initial something
			if(method_exists($this,"init")){
				$this->init();
			}
			if(method_exists($this,$method)){
				$this->$method();
			}else{
				echo "The requested method doesn't exist!";
			}
		}
		
		public function __destruct(){

			if($this->view instanceof View){
				require $this->view->viewFile;
			}
		}
	}
?>