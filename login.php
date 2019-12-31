<?php
	require './lib/init.php';
	session_start();

	//检测是否有数据提交
	if(empty($_POST)){
		require PATH.'/view/front/login.html';
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
	$sql = "select * from  user_pswd where nbxw_user = '$username'";
	$info = myGetRow($sql);
	if(strtolower($authcode) != strtolower($_SESSION['authcode'])){
		error("验证码错误");
	}else if(empty($info)){
		error("账号错误");
	}else if($info['nbxw_pswd'] != $password){
		error("密码错误");
	}

	//获取部门的id
	$sql = "select dept_id from user_pswd where nbxw_user = '$username'";
	$username = myGetOne($sql);

	//登录成功，设置两个cookie,分别是name 和 md5($name.$salt)(在配置文件中)后的
	setcookie('username', $username, time()+7200);
	setcookie('salt', cCode($username), time()+7200);
	header('location:newxw.php');
?>