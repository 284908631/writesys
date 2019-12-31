<?php
	require './lib/init.php';
	//var_dump($_GET);

	if(!empty($_POST)){
		if(empty($_GET['nbxw_user'])){
			errot("用户名不能为空");
		}
		if(empty($_POST['nbxw_pswd'])){
			error("密码不能为空");
		}
		$username = $_GET['nbxw_user'];
		$passward = $_POST['nbxw_pswd'];
		$sql = "update user_pswd set nbxw_pswd = $passward where nbxw_user = $username";
		$result = myQuery($sql);
		if(!$result){
			error("修改失败");
		}else{
			header("location:manage.php");
		}
		
	}
	if(!empty($_GET['nbxw_user'])){
		$user = $_GET['nbxw_user'];
		$sql = "select * from user_pswd,dept where nbxw_user = $user and dept.dept_id = user_pswd.dept_id";
		$user = myGetRow($sql);
		//var_dump($user);
	}
	

	require PATH.'/view/admin/user_pswdup.html';

?>