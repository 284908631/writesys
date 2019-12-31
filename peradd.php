<?php
	require './lib/init.php';
	checkManage();
	//var_dump($_POST);
	//exit();
	if(!empty($_POST)){
		if(empty($_POST['emp_name'])){
			error("姓名不能为空");
		}
		if(empty($_POST['emp_sex'])){
			error("性别不能为空");
		}
		if(empty($_POST['dept_id'])){
			error("部门不能为空");
		}
		if(empty($_POST['emp_tel'])){
			error("电话不能为空");
		}
		if(empty($_POST['emp_email'])){
			error("邮箱不能为空");
		}
		$data['emp_name'] = htmlspecialchars($_POST['emp_name']);
		$data['emp_sex'] = htmlspecialchars($_POST['emp_sex']);
		$data['dept_id'] = htmlspecialchars($_POST['dept_id']);
		$data['emp_tel'] = htmlspecialchars($_POST['emp_tel']);
		$data['emp_email'] = htmlspecialchars($_POST['emp_email']);
		$result = myExec('personnel',$data);
		if(!$result){
			error("错误");
		}
		header("location:./perlist.php");
	}
	$depts = getDepts();

	require PATH.'/view/admin/peradd.html';

?>