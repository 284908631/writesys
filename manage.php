<?php 
	require './lib/init.php';
	checkManage();
	$sql = "select * from user_pswd,dept where user_pswd.dept_id = dept.dept_id order by dept.dept_id";
	$users = myGetAll($sql);
	//var_dump($users);

	require PATH.'/view/admin/userlist.html';
?>