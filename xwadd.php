<?php 
	require './lib/init.php';
	checkCookie();
	//获取部门名
	$depts = getDepts();
	if(!empty($_POST)){
		
		//判断数据完整
		if(empty($_POST['xw_title'])){
			error("标题不能为空");
		}
		if(empty($_POST['xw_content'])){
			error("内容不能为空");
		}
		if($_POST['xw_flag']=="Save Message"){
			$xw_flag = 0;
		}else if($_POST['xw_flag']=="Post Message"){
			$xw_flag = 1;
		}


		//检测是否有图片上传
		if(isset($_FILES['xw_wenjian']['name'])&&$_FILES['xw_wenjian']['name']!='' && $_FILES['xw_wenjian']['error']==0){
			//upload/2019/1213/abcde.jpg
			$path = createDir().'/'.randString().getExt($_FILES['xw_wenjian']['name']);
			$absPath = PATH.$path;
			//源文件名tmp_name
			$result = move_uploaded_file($_FILES['xw_wenjian']['tmp_name'], $absPath);
			if($result){
				$data['xw_wenjian'] = $path;
			}
		}


		$data['xw_title'] = htmlspecialchars($_POST['xw_title']);
		$data['xw_auther'] = $_COOKIE['username'];
		$data['xw_content'] = htmlspecialchars($_POST['xw_content']);
		$data['xw_date'] = time();
		$data['xw_flag'] = $xw_flag;
		$data['xw_to'] = htmlspecialchars($_POST['xw_to']);
		$data['xw_read'] = 0;

		//进行插入
		$result = myExec('xw', $data);
		if(!$result){
			error("添加失败");
		}
		header("location:myxw.php");
		
	}
	require PATH.'/view/admin/xwadd.html';
?>