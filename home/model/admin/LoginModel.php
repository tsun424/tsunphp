<?php
/**
 *	LoginModel
 ************************************************************************
 *	@Author Xiaoming Yang
 *	@Initial date	2015-10-07 23:33
 ************************************************************************
 *	update time			editor				updated information
 */

class LoginModel {

    public function login($userName,$password){
        $sql = 'select * from t_pub_user where userName = ? and userPwd = ?';
        $resultArr = DB::select($sql,[$userName,$password]);
        return $resultArr;
    }
}