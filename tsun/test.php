<?php
	
	
	define("TSUN_PATH",rtrim(FRAME_PATH,'/').'/');	//the framework relative path
	define("PROJECT_PATH",dirname(TSUN_PATH).'/');	//the project relative path
	define("APP_PATH",APP.'/');						//the application relative path
	define("ROOT_FILE",__FILE__);

	echo ROOT_FILE;

	
/* 	$controller = APP_PATH."controller/a.class.php";
	
	echo $controller."<br>";
	if(file_exists($controller)){
		echo "file exists";
	}else{
		echo "file doesn't exists";
	} 
	function __autoload($className){
		include strtolower($className).".php";
	}
	
	$controllerDir = APP_PATH."controller";
	
	$include_path = get_include_path();
	$include_path .= PATH_SEPARATOR.$controllerDir;
	$include_path .= PATH_SEPARATOR.TSUN_PATH."base";
	
	set_include_path($include_path);
	
	URLTool::parseURL();
	
	echo $_REQUEST['rController'];
	echo $_REQUEST['rMethod'];
	*/
	
?>