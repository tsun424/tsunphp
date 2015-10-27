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
	*   2015-09-30          Xiaoming Yang       include Load class to realise autoload class function
	*   2015-10-27          Xiaoming Yang       1. delete the SLASH constant, use "/" directly
    *                                           2. add ROOT_PATH constant for js and css import in views
	*/
	
	
	//define system constant variables
	define("TSUN_PATH",BASE_PATH.SLASH."tsun");		        //the framework abosolute path
	define("ROOT_FILE",$_SERVER['SCRIPT_NAME']);			//the currently executing script. it is for views 
    $root_path = substr(ROOT_FILE,0,strpos(ROOT_FILE,'/',1));
    define("ROOT_PATH",$root_path);      //the root path of the project, it is for js and css import

    require(TSUN_PATH.SLASH."base/Load.php");
    Load::registerAuto();

	URLTool::parseURL();
	
	$requestController = (!empty($_REQUEST['rController']) ? ucfirst($_REQUEST['rController'])."Controller" : "LoginController");

	$class = new $requestController();
	$class->run();	
?>