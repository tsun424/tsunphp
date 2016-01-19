<?php
/**
 * Created by PhpStorm.
 * User: zy
 * Date: 2016/1/20
 * Time: 11:43
 */

class IdGenerator {

    public static function orderNum(){
        return date("ymdHis").str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    }
}