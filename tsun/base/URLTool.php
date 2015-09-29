	<?php
	/**
	*	handle the request information, request format should be like: ./index.php/controller/method
	*	put the requested controller information to $_REQUEST['rController']
	*	put the requested method information to $_REQUEST['rMethod']
	************************************************************************
	*	@Author Xiaoming Yang
	*	@Initial date	28-09-2015 20:08
	************************************************************************
	*	update time			editor				updated information
	*
	*/
	class URLTool{
		
		public static function parseURL(){
			if(isset($_SERVER['PATH_INFO'])){
				$pathInfo = $_SERVER['PATH_INFO'];
				
				$requestArr = explode('/',trim($pathInfo,'/'));
				//var_dump($requestArr);
				if(count($pathInfo) != 0){
					$_REQUEST['rController'] = $requestArr[0];
					$_REQUEST['rMethod'] = (!empty($requestArr[1]) ? $requestArr[1] : 'index');	//default method is index
				}
			}
		}
	}

?>