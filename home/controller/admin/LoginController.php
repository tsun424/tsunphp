<?php

	class LoginController extends Controller{

        private $loginModel;

        public function __construct(){
            $this->loginModel = ModelFactory::build('login');
        }

		function login(){
            $userName = $_REQUEST['username'];
            $userPwd = $_REQUEST['userpwd'];
            $result = $this->loginModel->login($userName,$userPwd);
            if($result == 'success'){
                $this->view = View::build('welcome');
            }else{
                $this->view = View::build('failure');
            }

		}
		function index(){
            $this->view = View::build('admin/LoginView');
		}
	}