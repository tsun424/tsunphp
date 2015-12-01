<?php
/**
 *	Load basic classes and requested controllers
 ************************************************************************
 *	@Author Xiaoming Yang
 *	@Date	2015-09-30 14:11
 ************************************************************************
 *	update time			editor				updated information
 *  2015-10-07          Xiaoming Yang       comment autoload model class part
 *  01-12-2015          Xiaoming Yang       optimise exception output
 */

    class Load{

        /**
         * autoload method for controllers and models
         */
        protected static function autoloadMC($className){
            if(strpos($className,'Controller') !== false && strpos($className,'Controller') > 0){
                $controllerArr = require(APP_PATH . "/conf/controllers.config.php");
                $action = substr($className,0,strlen($className)-10);
                $action = strtolower($action);
                if(isset($controllerArr[$action])){
                    include APP_PATH."/controller/".$controllerArr[$action];
                }else{
                    throw new Exception("The requested controller ".$action." doesn't exist.");
                }
            }/* 2015-10-07 comment this part, the model will be instanced by Model factory
                else if(strpos($className,'Model') !== false && strpos($className,'Model') > 0){
                $modelArr = require(APP_PATH . SLASH . "conf/models.config.php");
                $action = substr($className,0,count($className)-6);
                $action = strtolower($action);
                if(isset($controllerArr[$action])){
                    include APP_PATH.SLASH."controller".SLASH.$controllerArr[$action];
                }else{
                    throw new Exception("The requested model doesn't exist.");
                }
            }*/
        }

        protected static function autoloadBase($className){
            include $className.".php";
        }

        public static function registerAuto(){
            $include_path = get_include_path();
            $include_path .= PATH_SEPARATOR.TSUN_PATH."/base";
            set_include_path($include_path);
            spl_autoload_register('Load::autoloadMC');
            spl_autoload_register('Load::autoLoadBase');
        }
    }

?>