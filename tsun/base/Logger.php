<?php
/**
 *	class Logger provides log related function
 ************************************************************************
 *	@Author Xiaoming Yang
 *	@Date	04-01-2016 14:14
 ************************************************************************
 *	update time			editor				updated information
 */

class Logger{

    private $logLevel;
    private $logPath;

    public function __construct(){
        $logArr = require(APP_PATH."/conf/log.config.php");
        $this->logLevel = $logArr['level'];
        $this->logPath = APP_PATH."/".ltrim($logArr['file'],'/');
    }

    public function __get($param){
        return $this->$param;
    }
    public function __set($name,$value){
        $this->$name = $value;
    }

    public function debug($message){
        $this->log('DEBUG',$message);
    }
    public function info($message){
        $this->log('INFO',$message);
    }
    public function error($message){
        $this->log('ERROR',$message);
    }
    public function warn($message){
        $this->log('WARN',$message);
    }

    public function log($logLevel,$message){
        if($logLevel == strtoupper($this->logLevel)){
            if(!file_exists($this->logPath)){
                $logDir = dirname($this->logPath);
                $dirArr = explode('/', $logDir);
                $aimDir = '';
                foreach ($dirArr as $dir) {
                    $aimDir .= $dir . '/';
                    if (!file_exists($aimDir)) {
                        mkdir($aimDir);
                    }
                }
                touch($this->logPath);
            }
            if(is_writable($this->logPath)){
                $content = date('Y-m-d H:i:s') . ' [' . $logLevel . '] ' . $message . "\n";
                file_put_contents($this->logPath, $content, FILE_APPEND);
            }else{
                new Exception("The log file cannot be written.");
            }

        }
    }

}