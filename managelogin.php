<?php
	require './lib/init.php';
	session_start();

	//检测是否有数据提交
	if(empty($_POST)){

		require PATH.'/view/front/managelogin.html';
		exit();
	}
	
	//获取输入的账号密码
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$authcode = trim($_POST['authcode']);
	
	//不能为空
	if($username == '')
		error("账号不能为空");
	else if($password == '')
		error("密码不能为空");
	else if($authcode == '')
		error("验证码不能为空");

	//对比信息
	$sql = "select * from  manage where username = '$username'";
	$info = myGetRow($sql);
	//echo $info['nbxw_pswd'];
	if(strtolower($authcode) != strtolower($_SESSION['authcode'])){
		error("验证码错误");
	}else if(empty($info)){
		error("账号错误");
	}else if($info['password'] != $password){
		error("密码错误");
	}

	
	setcookie('_user', $username, time()+7200);
	$arr = require './lib/config.php';
	$salt = $arr['salt'];
	setcookie('_salt', cCode($username), time()+7200);
	header('location:manage.php');

?>