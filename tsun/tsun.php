<?php
	/**
	*	The entrance of the whole framework
	*	put the requested controller information to $_REQUEST['rController']
	*	put the requested method information to $_REQUEST['rMethod']
	************************************************************************
	*	@Author Xiaoming Yang
	*	@Initial date	28-09-2015 10:48
	************************************************************************
	*	update time			editor				updated information
	*	2015-09-29			Xiaoming Yang		change the path from relative to absolute
	*
	*/
	
	
	//define system constant variables
	define("SLASH","/");									//the slash separator
	define("TSUN_PATH",BASE_PATH.SLASH."tsun".SLASH);		//the framework abosolute path
	define("APP_PATH",APP.SLASH);							//the application abosolute path
	define("ROOT_FILE",$_SERVER['SCRIPT_NAME']);			//the currently executing script. it is for views 
	
	function __autoload($className){
		include $className.".php";
		//echo "$className.php is included.<br>";
	}
	
	$controllerDir = APP_PATH."controller";
	
	$include_path = get_include_path();
	$include_path .= PATH_SEPARATOR.$controllerDir;
	$include_path .= PATH_SEPARATOR.TSUN_PATH."base";
	
	set_include_path($include_path);

	URLTool::parseURL();
	
	$requestController = (!empty($_REQUEST['rController']) ? ucfirst($_REQUEST['rController'])."Controller" : "LoginController");

	$class = new $requestController();
	$class->run();	
?>