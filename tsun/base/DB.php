<?php
/**
 *	DB class for communicate with database
 ************************************************************************
 *	@Author Xiaoming Yang
 *	@Date	2015-10-12 22:04
 ************************************************************************
 *	update time			editor				updated information
 */

class DB {

    private $conn;

    public function __construct(){

        //$dbParams = require(APP_PATH.SLASH."conf/db.config.php");
        $dbParams = require("E:/PHP/wamp/www/framework/home/conf/db.config.php");
        $dsn = 'mysql:host='.$dbParams['mysql']['host'].';dbname='.$dbParams['mysql']['database'];
        $this->conn = new PDO($dsn, $dbParams['mysql']['username'], $dbParams['mysql']['password']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected static function build(){
        return new DB();
    }

    protected function select($sql,$paraArr){
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($paraArr);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function __callStatic($method,$args){
        $dbInstance = static::build();

        switch (count($args)) {
            case 0:
                return $dbInstance->$method();

            case 1:
                return $dbInstance->$method($args[0]);

            case 2:
                return $dbInstance->$method($args[0], $args[1]);

            case 3:
                return $dbInstance->$method($args[0], $args[1], $args[2]);

            case 4:
                return $dbInstance->$method($args[0], $args[1], $args[2], $args[3]);

            default:
                return call_user_func_array([$dbInstance, $method], $args);
        }

    }
}