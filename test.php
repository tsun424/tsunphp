<?php
	define("SLASH","/");									//the slash separator
	define("TSUN_PATH",BASE_PATH.SLASH."tsun".SLASH);		//the framework abosolute path
	define("APP_PATH",APP.SLASH);							//the application abosolute path

	echo TSUN_PATH."<br>";
	echo APP_PATH."<br>";
	echo $_SERVER['SCRIPT_NAME']."<br>";
	
/* 	define('BASE_PATH', __DIR__);
	echo BASE_PATH; */
	
	/* echo "separator=".DIRECTORY_SEPARATOR."<br>";
	echo "PATH_SEPARATOR=".PATH_SEPARATOR."<br>";
	echo DIRECTORY_SEPARATOR; */
	
?>