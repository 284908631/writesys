<?php
	require './lib/init.php';
	checkManage();
	if(empty($_GET['emp_id'])){
		error("无正确id"); 
	}
	$emp_id = $_GET['emp_id'];

	if(!empty($_POST)){
		if(empty($_POST['emp_name'])){
			error("姓名不能为空");
		}
		if(empty($_POST['emp_tel'])){
			error("tel不能为空");
		}
		if(empty($_POST['emp_email'])){
			error("email不能为空");
		}
		$data['emp_name']=htmlspecialchars($_POST['emp_name']);
		$data['emp_sex']=htmlspecialchars($_POST['emp_sex']);
		$data['dept_id']=htmlspecialchars($_POST['dept_id']);
		$data['emp_tel']=htmlspecialchars($_POST['emp_tel']);
		$data['emp_email']=htmlspecialchars($_POST['emp_email']);
		$where = "emp_id = $emp_id";
		$result = myExec('personnel',$data,$where,'update');
		if(!$result){
			error("修改失败");
		}
		header("location:perlist.php");
	}
	
	//获取该工号的员工
	$sql = "select * from personnel where emp_id = ".$_GET['emp_id'];
	$per = myGetRow($sql);

	//获取所有部门
	$depts = getDepts();
	require PATH.'/view/admin/perup.html';
?>