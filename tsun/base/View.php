<?php
	/**
	*	The view class for views, will be called in the controller classes
	************************************************************************
	*	@Author Xiaoming Yang
	*	@Initial date	2015-09-29 14:46
	************************************************************************
	*	update time			editor				updated information
	*/
	class View{
		protected $viewFile;
		
		public function __construct($viewFile){
			$this->viewFile = $viewFile;
		}
		
		public static function build($viewName){
			$viewFile = self::getFilePath($viewName);
			if(file_exists($viewFile)){
				return new View($viewFile);
			}else{
				echo "The requested view $viewFile doesn't exist.";
				//throw an exception here --to be finished
			}
			
		}
		
		protected static function getFilePath($viewName){
			
			$viewName = trim($viewName,"/");
			//the path may be configured here --to be finished
			return APP_PATH."/view/".$viewName.".php";
		}
		
		public function __get($propertyName){
			if(isset($propertyName)){
				return $this->$propertyName;
			}else{
				return null;
			}
		}
		
	}
?>