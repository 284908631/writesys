<?php
	require './lib/init.php';
	checkCookie();
	$dept_id = $_COOKIE['username'];
	$sql = "select * from user_pswd where dept_id = $dept_id";
	//echo $sql;
	$user = myGetRow($sql);
	$nbxw_user = $user['nbxw_user'];
	//var_dump($_POST);
	if(!empty($_POST)){
		if(empty($_POST['old_nbxw_pswd'])){
			error("原密码不能为空");
		}
		if(empty($_POST['new_nbxw_pswd1'])){
			error("新密码不能为空");
		}
		if(empty($_POST['new_nbxw_pswd2'])){
			error("确认密码不能为空");
		}
		if($_POST['old_nbxw_pswd']!=$user['nbxw_pswd']){
			error("密码不正确");
		}
		if($_POST['new_nbxw_pswd1'] != $_POST['new_nbxw_pswd2']){
			error("两密码不相同");
		}
		$nbxw_pswd = $_POST['new_nbxw_pswd1'];
		$sql = "update user_pswd set nbxw_pswd = $nbxw_pswd where nbxw_user = $nbxw_user";
		//die($sql);
		$result = myQuery($sql);
		if(!$result){
			error("密码修改失败");
		}
		//$referer = $_SERVER['HTTP_REFERER'];
		//header("location:$referer");
		succ("密码修改成功");
		
	}
	


	//var_dump($user);
	require PATH.'/view/admin/user.html'
?>