<?php
	require './lib/init.php';
	
	//有数据提交
	if(!empty($_POST)){
		
		//数据正确性
		if(empty($_POST['xw_title'])){
			error("标题不能为空");
		}
		if(empty($_POST['xw_id'])){
			error("行文id不能为空");
		}
		if(empty($_POST['xw_content'])){
			error("行文内容不能为空");
		}

		//判断是保存还是发布
		if($_POST['xw_flag']=="Save Message"){
			$xw_flag = 0;
		}else if($_POST['xw_flag']=="Post Message"){
			$xw_flag = 1;
		}
	
		$data['xw_title'] = htmlspecialchars($_POST['xw_title']);
		$data['xw_auther'] = $_COOKIE['username'];
		$data['xw_content'] = htmlspecialchars($_POST['xw_content']);
		$data['xw_date'] = time();
		$data['xw_flag'] = $xw_flag;
		$data['xw_to'] = htmlspecialchars($_POST['xw_to']);
		$data['xw_read'] = 0;
		$where = " xw_id =".$_POST['xw_id'];

		//获取更新结果
		$result = myExec('xw', $data, $where, 'update');
		
		header("location:myxw.php");
	}


	//获取所有部门
	$depts = getDepts();

	//获取行文信息
	if(isset($_GET['xw_id'])&&is_numeric($_GET['xw_id'])){
		$sql = "select * from xw where xw_id = ".$_GET['xw_id'];
		$xw = myGetRow($sql);
	}
	require PATH.'/view/admin/xwup.html';
?>