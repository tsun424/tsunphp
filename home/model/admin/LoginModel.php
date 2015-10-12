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
        $sql = 'select * from t_pub_user where user_name = ? and user_pwd = ?';
        $resultArr = DB::select($sql,[$userName,$password]);
        if(count($resultArr)>0){
            return "success";
        }else{
            return "failure";
        }
    }
}