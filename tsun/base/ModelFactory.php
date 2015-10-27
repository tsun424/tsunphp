<?php
/**
 *	model factory class, find model class and request it from the controller
 ************************************************************************
 *	@Author Xiaoming Yang
 *	@Date	2015-10-07 14:32
 ************************************************************************
 *	update time			editor				updated information
 *   2015-10-27          Xiaoming Yang       1. delete the SLASH constant, use "/" directly
 */

class ModelFactory {


    public static function build($modelName){
        try{
            $modelArr = self::getFilePath($modelName);
        }catch(Exception $e){
            //will record log information after import log module--to be developed
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return false;
        }
        if(count($modelArr) == 2){
            require($modelArr[1]);
            return new $modelArr[0]();
        }else{
           return false;
        }
    }

    protected static function getFilePath($modelName){
        $resultArr = array();
        $modelArr = require(APP_PATH."/conf/models.config.php");
        if(isset($modelArr[$modelName])){
            $pos = strrpos($modelArr[$modelName],"/");
            if($pos !== false){
                $modelFile = substr($modelArr[$modelName],$pos+1);

            }else{
                $modelFile = $modelArr[$modelName];
            }
            $modelFilePath = APP_PATH."/model/".$modelArr[$modelName];
            $modelClass = substr($modelFile,0,strlen($modelFile)-4);
            if(file_exists($modelFilePath)){
                $resultArr[] = $modelClass;
                $resultArr[] = $modelFilePath;
            }else{
                throw new Exception("The requested model file ".$modelFilePath." cannot be found.");
            }
            return $resultArr;
        }else{
            throw new Exception("The requested model ".$modelName." hasn't been configured in models.config.php.");
        }
    }
}