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
     *  29-11-2015          Xiaoming Yang       add condition for handling get method request
	*
	*/
	class URLTool{
		
		public static function parseURL(){
			if(isset($_SERVER['PATH_INFO'])){
				$pathInfo = $_SERVER['PATH_INFO'];
				
				$requestArr = explode('/',trim($pathInfo,'/'));

				if(count($pathInfo) != 0){
					$_REQUEST['rController'] = $requestArr[0];
                    if(!empty($requestArr[1])){
                        $isGet = strpos($requestArr[1],'?');
                        if($isGet){
                            $_REQUEST['rMethod'] = substr($requestArr[1],0,$isGet);
                        }else{
                            $_REQUEST['rMethod'] = $requestArr[1];
                        }
                    }else{
                        $_REQUEST['rMethod'] = 'index';     //default method is index
                    }
				}
			}
		}
	}

?>