<?php

	class LoginController extends Controller{
		
		function login(){
			
			echo $_REQUEST['str']."<br>";
		}
		function index(){
			echo "login index is called";
		}
	}
?>