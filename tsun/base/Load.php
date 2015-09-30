<?php
/**
 *	Load basic classes and requested controllers and models
 ************************************************************************
 *	@Author Xiaoming Yang
 *	@Date	2015-09-30 14:11
 ************************************************************************
 *	update time			editor				updated information
 */

    class Load{

        /**
         * autoload method for controllers and models
         */
        protected static function autoloadMC($className){

            if(strpos($className,'Controller') !== false && strpos($className,'Controller') > 0){
                $controllerArr = require(APP_PATH . SLASH . "conf/controllers.config.php");
                $action = substr($className,0,count($className)-11);
                $action = strtolower($action);
                if(isset($controllerArr[$action])){
                    include APP_PATH.SLASH."controller".SLASH.$controllerArr[$action];
                }else{
                    throw new Exception("The requested controller doesn't exist.");
                }
            }else if(strpos($className,'Model') !== false && strpos($className,'Model') > 0){
                $modelArr = require(APP_PATH . SLASH . "conf/models.config.php");
                $action = substr($className,0,count($className)-6);
                $action = strtolower($action);
                if(isset($controllerArr[$action])){
                    include APP_PATH.SLASH."controller".SLASH.$controllerArr[$action];
                }else{
                    throw new Exception("The requested model doesn't exist.");
                }
            }
        }

        protected static function autoloadBase($className){
            include $className.".php";
        }

        public static function registerAuto(){
            $include_path = get_include_path();
            $include_path .= PATH_SEPARATOR.TSUN_PATH.SLASH."base";
            set_include_path($include_path);
            spl_autoload_register('Load::autoloadMC');
            spl_autoload_register('Load::autoLoadBase');
        }
    }

?>