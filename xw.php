<?php 
	require './lib/init.php';
	checkCookie();
	/*var_dump($_POST);
	var_dump($_GET);exit();*/
	//获取行文内容
	if(!empty($_GET)&&!empty($_GET['xw_id'])){
		
		$xw_id = $_GET['xw_id'];
		$sql = "select * from xw where xw_id = $xw_id ";
		$xw = myGetRow($sql);
	}else{
		header("myxw.php");
	}

	//获取行文处理
	$sql = "select * from xwcl where xw_id=".$xw_id;
	$xwcls = myGetAll($sql);


	//判断是否有数据提交
	if(!empty($_POST)){

		if(!empty($_POST['xwcl_content'])){
			$xwcl_content = $_POST['xwcl_content'];
		}
		/*if(!empty($_POST['xwcl_content'])){
			$xwcl_content = $_POST['xwcl_content'];
		}*/
		$data['xw_id'] = $xw_id;
		$data['xwcl_content'] = $xwcl_content;
		$data['xw_receiver '] = $_COOKIE['username'];
		$data['xwcl_date'] = time();
		$result = myExec('xwcl', $data);
		if(!$result){
			error("评论失败");
		}
		$referer = $_SERVER['HTTP_REFERER'];
		//echo $referer;exit();
		header("location:$referer");
	}
	

	require PATH.'/view/admin/xw.html';
?>